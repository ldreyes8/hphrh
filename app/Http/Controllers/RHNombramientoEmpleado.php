<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Storage;
use DB;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Empleado;
use App\Puesto;
use App\Afiliado;
use App\Nomytras;
use App\Vacadetalle;
use App\Asignajefe;
use App\Persona;
use App\Constants;

use App\Http\Requests\Nomrequest;



class RHNombramientoEmpleado extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

    	$casos=DB::table('caso as c')
        ->select('c.idcaso','c.nombre')
        ->where('c.idcaso','=',6)
        
        ->orderBy('c.nombre','asc')
        ->get();

        $queryN=trim($request->get('searchText'));  
        $query=trim($request->get('select'));

        $empleado=Empleado::join('nomytras as nt','empleado.idempleado','=','nt.idempleado')
        ->join('status as st','empleado.idstatus','=','st.idstatus')
        ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
        ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
        ->join('caso as c','c.idcaso','=','nt.idcaso')
        ->select('empleado.idempleado','empleado.identificacion','empleado.nit','st.statusemp as statusn','pu.nombre as puesto','af.nombre as afiliado','c.idcaso',DB::raw('max(nt.idnomytas) as idnomytas'))
        ->where('empleado.idstatus','=', 2)
        ->groupBy('empleado.idempleado')      
        ->orderBy('empleado.idempleado','desc')
        ->paginate(15);

        $status = DB::table('status as st')
        ->select('st.idstatus','st.statusemp')
        ->where('st.idstatus','=',5)
        ->get();
        /*
    	       $puestos=Puesto::all();

        $caso=DB::table('caso as c')
        ->select('c.idcaso','c.nombre')
        ->where('c.idcaso','=',6)
        ->get();

        $jefesinmediato=DB::table('persona as per')
        ->join('empleado as em','per.identificacion','=','em.identificacion')
        ->join('status as sts','em.idstatus','=','sts.idstatus')
        ->select('per.identificacion','per.nombre1','per.nombre2','per.apellido1','per.apellido2')
        ->where('em.idstatus','=',2)
        ->get();


        return view("rrhh.empleados.nombramiento",["puestos"=>$puestos,"afiliados"=>$afiliados,"caso"=>$caso,"empleado"=>$empleado,"jefesinmediato"=>$jefesinmediato]);

        */
        return view("rrhh.empleados.indexnombramiento",["empleado"=>$empleado,"searchText"=>$queryN,"casos"=>$casos,"select"=>$query,"status"=>$status]);
    }
    

    public function busqueda($caso,$dato="")
    {

        $empleado= Empleado::Busqueda($caso,$dato)->join('nomytras as nt','empleado.idempleado','=','nt.idempleado')
        ->join('status as st','empleado.idstatus','=','st.idstatus')
        ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
        ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
        ->join('caso as c','c.idcaso','=','nt.idcaso')
        ->select('empleado.idempleado','empleado.identificacion','empleado.nit','st.statusemp as statusn','pu.nombre as puesto','af.nombre as afiliado','c.idcaso',DB::raw('max(nt.idnomytas) as idnomytas'))
        ->where('empleado.idstatus','!=', 5)
        ->groupBy('empleado.idempleado')      
        ->orderBy('empleado.idempleado','desc')
        ->paginate(20);

        $status = DB::table('status as st')
        ->select('st.idstatus','st.statusemp')
        ->where('st.idstatus','=',5)
        ->get();

        return view('rrhh.empleados.indexnombramiento')
        ->with("empleado", $empleado )
        ->with("status", $status);
    }


    public function addnombramiento($id)
    {
        $puestos=Puesto::all();


        $empleado=DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->select('e.idempleado','p.nombre1','p.apellido1','p.nombre2','p.apellido2','p.idpuesto','p.idafiliado')
        ->where('e.idempleado','=',$id)
        ->first();

        $afiliados=Afiliado::all();

        $caso=DB::table('caso as c')
        ->select('c.idcaso','c.nombre')
        ->where('c.idcaso','=',6)
        ->get();


        $jefesinmediato=DB::table('persona as per')
        ->join('empleado as em','per.identificacion','=','em.identificacion')
        ->join('status as sts','em.idstatus','=','sts.idstatus')
        ->select('per.identificacion','per.nombre1','per.nombre2','per.apellido1','per.apellido2')
        ->where('em.idstatus','=',2)
        ->get();

        $jefeasignado = DB::table('persona as per')
        ->join('empleado as em','per.identificacion','=','em.identificacion')
        ->join('asignajefe as aj','per.identificacion','=','aj.identificacion')
        ->select('per.identificacion','per.nombre1','per.nombre2','per.apellido1','per.apellido2')
        ->where('aj.idempleado','=',$id)
        ->get();

        $jefe1 = new Asignajefe();

        $jefes = $jefe1->selectQuery(Constants::ASIGNAJEFE_PROYECTO_QUERY,array($id));

        return view("rrhh.empleados.nombramiento",["puestos"=>$puestos,"afiliados"=>$afiliados,"caso"=>$caso,"empleado"=>$empleado,"jefesinmediato"=>$jefesinmediato,"jefeasignado"=>$jefeasignado,"jefes"=>$jefes]);
        //return Redirect::to('listados/pprueba/create');
    }

    public function asignar_jefeinmediato($idempleado,$identificacion,$notifica){

        $asignajefe = new asignajefe;
        $asignajefe->identificacion = $identificacion;
        $asignajefe->idempleado = $idempleado;
        if($notifica == "No")
        {
            $notifica =0;
        }
        if($notifica == "Si")
        {
            $notifica = 1;
        }
        $asignajefe->notifica = $notifica;

        $asignajefe->save();

        $usuario=Empleado::find($idempleado);
        $jefeasignado=$usuario->getpersonas();

       return json_encode ($jefeasignado); 
    }

    public function quitar_jefeinmediato($idempleado,$identificacion){

        $empleado=Empleado::find($idempleado);
        $empleado->revokePersona($identificacion);
        $jefeasignado=$empleado->getpersonas();
        return json_encode ($jefeasignado);
    }

    public function addasecenso(Nomrequest $request)
    {


        $miArray1 = $_POST["items"];

        
       
        try 
        {
            $miArray = $request->items;
            
            $idem = $request->get('idempleado');
            $idco = $request->get('idcaso');
            //$idji = $request->get('idjefe');
            $today = Carbon::now();
            $year = $today->format('Y');

            $fecha=$request->get('fecha');
            $fecha=Carbon::createFromFormat('d/m/Y',$fecha);
            $fecha=$fecha->format('Y-m-d');

            
            $nomtras=new Nomytras;
            $nomtras-> idpuesto=$request->get('idpuesto');
            $nomtras-> idempleado=$idem;
            $nomtras-> fecha=$fecha;
            $nomtras-> salario=$request->get('salario');
            $nomtras-> descripcion=$request->get('descripcion');
            $nomtras-> idafiliado=$request->get('idafiliado');
            $nomtras-> idcaso=$idco;
            $nomtras->save();

            $asignajefe = new Asignajefe;


            foreach ($miArray as $key => $value) {
                $notifica = $value['1'];

                if($notifica == "No")
                {
                    $notifica =0;
                }
                if($notifica == "Si")
                {
                    $notifica = 1;
                }

                $asignajefe->idempleado = $idem;
                $asignajefe->identificacion = $value['0'];
                $asignajefe->notifica = $notifica;
                $asignajefe->save();
                
 //               dd($key, $value['0'],$value['1'] );
            }

                //$st=Empleado::find($idem);
                //$st-> fechaingreso=$fecha;
                //$st-> idjefeinmediato=$idji;
                //$st-> idstatus='2';
                //$st-> update();
            

        } catch (Exception $e) 
        {
            DB::rollback();
            return response()->json(array('error' => 'No se ha podido enviar la peticion de agregar nuevo nombramiento y/o asecenso'),404);         
        }
        return json_encode ($asignajefe); 
        //return Redirect::to('listados/pprueba');
    }

    public function show($id)
    {
        $municipio=DB::table('persona as p')
        ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
        ->select('m.idmunicipio')
        ->where('p.identificacion','=',$id)
        ->first();

        if (empty($municipio->idmunicipio)) {
          $persona=DB::table('persona as p')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
            ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
            ->select('p.identificacion','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.celular as telefono','p.fechanac','p.barriocolonia','a.nombre as afiliado','pu.nombre as puesto','p.finiquitoive')
            ->where('em.identificacion','=',$id)
            ->first();
        }
        else
        {    
            $persona=DB::table('persona as p')
            ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
            ->join('departamento as dp','m.iddepartamento','=','dp.iddepartamento')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
            ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
            ->select('p.identificacion','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.celular as telefono','p.fechanac','p.barriocolonia','dp.nombre as departamento','m.nombre as municipio','a.nombre as afiliado','pu.nombre as puesto','p.finiquitoive')
            ->where('em.identificacion','=',$id)
            ->first();
        }
        //dd($persona,$municipio);
        /*$downloads=DB::table('persona as p')
        ->select('p.finiquitoive')
        ->where('p.identificacion','=',$id)
        ->first();*/

        $empleado=DB::table('empleado as e')
        ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
        ->select('e.idempleado','e.identificacion','e.afiliacionigss','e.numerodependientes','e.aportemensual','e.vivienda','e.alquilermensual','e.otrosingresos','e.pretension','e.nit','e.fechasolicitud','ec.idcivil','ec.estado as estadocivil','e.observacion','e.idstatus')
        ->where('e.identificacion','=',$id)
        ->first();

        $academicos=DB::table('personaacademico as pc')
        ->join('persona as p','pc.identificacion','=','p.identificacion')
        ->join('nivelacademico as na','pc.idnivel','=','na.idnivel')
        ->select('pc.idpacademico' ,'pc.titulo','pc.establecimiento','pc.duracion','na.idnivel','na.nombrena as nivel','pc.fingreso','pc.fsalida','pc.observacion')
        ->where('pc.identificacion','=',$id)
        ->get();

        $experiencias=DB::table('personaexperiencia as pe')
        ->join('persona as p','pe.identificacion','=','p.identificacion')
        ->select('pe.idpexperiencia' ,'pe.empresa','pe.puesto','pe.jefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex','pe.observacion','pe.recomiendaexp','pe.confirmadorexp')
        ->where('pe.identificacion','=',$id)
        ->get();

        $familiares=DB::table('personafamilia as pf')
        ->join('persona as p','pf.identificacion','=','p.identificacion')
        ->select('pf.idpfamilia','pf.nombref','pf.apellidof','pf.telefonof','pf.parentezco','pf.ocupacion','pf.edad','pf.emergencia')
        ->where('p.identificacion','=',$id)
        ->get();

        $familiares1=DB::table('personafamilia as pf')
        ->join('persona as p','pf.identificacion','=','p.identificacion')
        ->select('pf.observacion')
        ->where('p.identificacion','=',$id)
        ->first();

        $idiomas=DB::table('empleadoidioma as ei')
        ->join('idioma as i','ei.ididioma','=','i.ididioma')
        ->join('empleado as e','ei.idempleado','=','e.idempleado')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->select('i.nombre as idioma','ei.nivel')
        ->where('p.identificacion','=',$id)
        ->get();

        $referencias=DB::table('personareferencia as pr')
        ->join('persona as p','pr.identificacion','=','p.identificacion')
        ->select('pr.idpreferencia' ,'pr.nombrer','pr.telefonor','pr.profesion','pr.tiporeferencia','pr.observacion','pr.recomiendaper','pr.confirmadorref')
        ->where('p.identificacion','=',$id)
        ->get();

        $deudas=DB::table('personadeudas as pd')
        ->join('persona as p','pd.identificacion','=','p.identificacion')
        ->select('pd.idpdeudas','pd.acreedor','pd.amortizacionmensual as pago','pd.montodeuda','pd.motivodeuda')
        ->where('p.identificacion','=',$id)
        ->get();

        $padecimientos =DB::table('personapadecimientos as pad')
        ->join('persona as p','pad.identificacion','=','p.identificacion')
        ->select('pad.idppadecimientos','pad.nombre')
        ->where('p.identificacion','=',$id)
        ->get();

        $pais=DB::table('trabajoextranjero as te')
        ->join('pais as ps','te.idpais','=','ps.idpais')
        ->join('persona as p','te.identificacion','=','p.identificacion')
        ->select('te.trabajoext','te.forma','te.motivofin','ps.nombre')
        ->where('p.identificacion','=',$id)
        ->get();

        $pariente=DB::table('puestopublico as pp')
        ->join('persona as p','pp.identificacion','=','p.identificacion')
        ->select('pp.nombre','pp.puesto','pp.dependencia')
        ->where('p.identificacion','=',$id)
        ->get();

        $entrev=DB::table('persona as p')
        ->join('empleado as e','e.identificacion','=','p.identificacion')
        ->join('entrevista as en','en.perentrevista','=','p.identificacion')
        ->select('en.identrevista')
        ->where('p.identificacion','=',$id)
        ->first();

        $observaciones=DB::table('persona as p')
        ->join('personaacademico as pa','pa.identificacion','=','p.identificacion')
        ->join('personafamilia as pf','pf.identificacion','=','p.identificacion')
        ->join('personareferencia as pr','pr.identificacion','=','p.identificacion')
        ->join('personaexperiencia as pe','pe.identificacion','=','p.identificacion')
        ->select('pa.observacion as obpa','pf.observacion as obpf','pr.observacion as obpr','pe.observacion as obpe')
        ->where('p.identificacion','=',$id)
        ->first();

        $observaR=DB::table('observaciones as ob')
            ->join('persona as p','p.identificacion','=','ob.identificacion')
            ->join('personareferencia as pr','pr.idpreferencia','=','ob.obreferencia')
            ->select('p.identificacion','ob.descripcion','pr.idpreferencia')
            ->where('p.identificacion','=',$id)
            ->get();
        
        $observaE=DB::table('observaciones as ob')
            ->join('persona as p','p.identificacion','=','ob.identificacion')
            ->join('personaexperiencia as pe','pe.idpexperiencia','=','ob.obexperiencia')
            ->select('p.identificacion','ob.descripcion','pe.idpexperiencia')
            ->where('p.identificacion','=',$id)
            ->get();
      
        $nivelacademico = DB::table('nivelacademico')->get();
        $estadocivil=DB::table('estadocivil')->get();


        return view('rrhh.nombramiento.show',["persona"=>$persona,"empleado"=>$empleado,"academicos"=>$academicos,"experiencias"=>$experiencias,"familiares"=>$familiares,"idiomas"=>$idiomas,"referencias"=>$referencias,"deudas"=>$deudas,"padecimientos"=>$padecimientos,"pais"=>$pais,"pariente"=>$pariente,"nivelacademico"=>$nivelacademico,"estadocivil"=>$estadocivil,"observaciones"=>$observaciones,'entrev'=>$entrev,"observaR"=>$observaR,"observaE"=>$observaE]);
    }

   
}
