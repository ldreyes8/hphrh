<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;


use Validator;
use DB;
use Carbon\Carbon; //para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Historia;

use App\Http\Requests\HistoriaRequest;
use App\Empleado;
use App\Persona;
use App\Caso;
use App\Bajas;
use App\User;


use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;




class ListadoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listado(Request $request)
    {
        return view('rrhh.empleados.index');
    }
    public function index (Request $request)
    {
    	
        $casos=DB::table('caso as c')
        ->select('c.idcaso','c.nombre')
        ->where('c.idcaso','=',6)
        ->orwhere('c.idcaso','=',4)
        ->orwhere('c.idcaso','=',7)
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
        ->where('empleado.idstatus','!=', 5)
        ->groupBy('empleado.idempleado')      
        ->orderBy('empleado.idempleado','desc')
        ->paginate(20);

        $status = DB::table('status as st')
        ->select('st.idstatus','st.statusemp')
        ->where('st.idstatus','=',5)
        ->get();

        return view("rrhh.empleados.generalemp",["empleado"=>$empleado,"searchText"=>$queryN,"casos"=>$casos,"select"=>$query,"status"=>$status]);
    }
  /*  public function busqueda($rol,$dato="")
    {
        $queryN=$dato;
        $query=$rol;
        $caso=DB::table('caso as c')
        ->select('c.idcaso','c.nombre')
        ->where('c.idcaso','=',6)
        ->orwhere('c.idcaso','=',4)
        ->orwhere('c.idcaso','=',7)
        ->orderBy('c.nombre','asc')
        ->get();
        $empleado=DB::table('empleado as e')
        ->join('status as st','e.idstatus','=','st.idstatus')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        
        ->join('nomytras as nt','e.idempleado','=','nt.idempleado')
        ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
        ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
        ->join('caso as c','c.idcaso','=','nt.idcaso')

        ->select('e.idempleado','e.identificacion','e.nit','e.afiliacionigss','e.numerodependientes','e.aportemensual','e.vivienda','e.alquilermensual','e.otrosingresos','p.nombre1','p.nombre2','p.apellido1','p.apellido2','st.statusemp as statusn','pu.nombre as puesto','af.nombre as afiliado','c.idcaso',DB::raw('max(nt.idnomytas) as idnomytas'))


        ->where('c.idcaso','LIKE','%'.$query.'%')
        ->where('p.nombre1','LIKE','%'.$queryN.'%')
        //->orwhere('p.apellido1','LIKE','%'.$queryN.'%')

        ->groupBy('e.idempleado')   
        ->orderBy('e.idempleado','desc')
        ->paginate(19); 

        return view("rrhh.empleados.generalemp",["empleado"=>$empleado,"searchText"=>$queryN,"caso"=>$caso,"select"=>$query]);
    }
*/
    public function busqueda($caso,$dato="")
    {
        $casos=Caso::where('idcaso','=',6)
        ->orwhere('idcaso','=',4)
        ->orwhere('idcaso','=',7)
        ->orderBy('nombre','asc')
        ->get();

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

        $casosel=$casos->find($caso);

        $status = DB::table('status as st')
        ->select('st.idstatus','st.statusemp')
        ->where('st.idstatus','=',5)
        ->get();


        return view('rrhh.empleados.generalemp')
        ->with("empleado", $empleado )
        ->with("casos", $casos)
        ->with("casosel", $casosel)
        ->with("status", $status);
    }

    public function show ($id)
    {
        $municipio=DB::table('persona as p')
        ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
        ->select('m.idmunicipio')
        ->where('p.identificacion','=',$id)
        ->first();

        if (empty($municipio->idmunicipio)) {
          $persona=DB::table('persona as p')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            //->join('afiliado as af','p.idafiliado','=','af.idafiliado')
            //->join('puesto as pu','p.idpuesto','=','pu.idpuesto')

            ->join('nomytras as nt','em.idempleado','=','nt.idempleado')
            ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
            ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')

            ->select('p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.celular as telefono','p.fechanac','p.barriocolonia','af.nombre as afiliado','pu.nombre as puesto','p.finiquitoive', DB::raw('max(nt.idnomytas) as idnomytas'))
            ->where('em.identificacion','=',$id)
            ->first();
        }
        else
        {    
            $persona=DB::table('persona as p')
            ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
            ->join('departamento as dp','m.iddepartamento','=','dp.iddepartamento')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            //->join('afiliado as af','p.idafiliado','=','af.idafiliado')
            //->join('puesto as pu','p.idpuesto','=','pu.idpuesto')

            ->join('nomytras as nt','em.idempleado','=','nt.idempleado')
            ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
            ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')

            ->select('p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.telefono','p.fechanac','p.avenida','p.calle','p.nomenclatura','p.zona','p.barriocolonia','dp.nombre as departamento','m.nombre as municipio','af.nombre as afiliado','pu.nombre as puesto',DB::raw('max(nt.idnomytas) as idnomytas'))
            ->where('em.identificacion','=',$id)
            ->first();
        }

        $empleado=DB::table('empleado as e')
        ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
        ->select('e.identificacion','e.afiliacionigss','e.numerodependientes','e.aportemensual','e.vivienda','e.alquilermensual','e.otrosingresos','e.pretension','e.nit','e.fechasolicitud','ec.estado as estadocivil','e.observacion')
        ->where('e.identificacion','=',$id)
        ->first();

        $academicos=DB::table('personaacademico as pc')
        ->join('persona as p','pc.identificacion','=','p.identificacion')
        ->join('nivelacademico as na','pc.idnivel','=','na.idnivel')
        ->select('pc.titulo','pc.establecimiento','pc.duracion','na.nombrena as nivel','pc.fingreso','pc.fsalida')
        ->where('pc.identificacion','=',$id)
        ->get();

        $experiencias=DB::table('personaexperiencia as pe')
        ->join('persona as p','pe.identificacion','=','p.identificacion')
        ->select('pe.empresa','pe.puesto','pe.jefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex')
        ->where('pe.identificacion','=',$id)
        ->get();

        $familiares=DB::table('personafamilia as pf')
        ->join('persona as p','pf.identificacion','=','p.identificacion')
        ->select('pf.nombref','pf.apellidof','pf.telefonof','pf.parentezco','pf.ocupacion','pf.edad','pf.emergencia')
        ->where('p.identificacion','=',$id)
        ->get();

        $idiomas=DB::table('empleadoidioma as ei')
        ->join('idioma as i','ei.ididioma','=','i.ididioma')
        ->join('empleado as e','ei.idempleado','=','e.idempleado')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->select('i.nombre as idioma','ei.nivel')
        ->where('p.identificacion','=',$id)
        ->get();

        $referencias=DB::table('personareferencia as pr')
        ->join('persona as p','pr.identificacion','=','p.identificacion')
        ->select('pr.nombrer','pr.telefonor','pr.profesion','pr.tiporeferencia')
        ->where('p.identificacion','=',$id)
        ->get();

        $deudas=DB::table('personadeudas as pd')
        ->join('persona as p','pd.identificacion','=','p.identificacion')
        ->select('pd.acreedor','pd.amortizacionmensual as pago','pd.montodeuda')
        ->where('p.identificacion','=',$id)
        ->get();

        $padecimientos =DB::table('personapadecimientos as pad')
        ->join('persona as p','pad.identificacion','=','p.identificacion')
        ->select('pad.nombre')
        ->where('p.identificacion','=',$id)
        ->get();
        return view('rrhh.empleados.show',["persona"=>$persona,"empleado"=>$empleado,"academicos"=>$academicos,"experiencias"=>$experiencias,"familiares"=>$familiares,"idiomas"=>$idiomas,"referencias"=>$referencias,"deudas"=>$deudas,"padecimientos"=>$padecimientos]);
    } 

    public function historial ($id)
    {
        $historia=DB::table('historia as h')
        ->join('empleado as e','h.idempleado','=','e.idempleado')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('asignajefe as aj','h.idasignajefe','=','aj.idasignajefe')
        ->select('h.idempleado','p.nombre1','p.apellido1','aj.idasignajefe','h.fecha','h.historia as hsa','h.comentario')
        ->where('e.idempleado','=',$id)
        ->get();

        for($i = 0; $i < sizeof($historia);$i++)
        {

            $asignajefe=DB::table('asignajefe as aj')
            ->join('persona as p','aj.identificacion','=','p.identificacion')
            ->join('historia as h','h.idasignajefe','=','aj.idasignajefe')
            
            ->select('p.nombre1','p.apellido1','aj.idasignajefe')               
            ->groupBy('p.nombre1','p.apellido1','aj.idasignajefe')
            ->where('h.idasignajefe','=',$historia[$i]->idasignajefe)
            ->get();
        }

        return view('listados.empleado.historial',["historia"=>$historia,"asignajefe" =>$asignajefe]);

    }
    public function Acta ($id)
    {   
        try {
            $empleado=DB::table('empleado as e')
        ->join('persona as ec','e.identificacion','=','ec.identificacion')
        ->select('e.idempleado','ec.nombre1','ec.apellido1')
        ->where('e.idempleado','=',$id)
        ->first();

        $asignajefe=DB::table('asignajefe as aj')
        ->join('persona as p','aj.identificacion','=','p.identificacion')
        ->join('users as us','p.identificacion','=','us.identificacion')
        ->join('empleado as e','aj.idempleado','=','e.idempleado')
        ->select('aj.idasignajefe','p.nombre1')
        ->where('us.id','=',Auth::user()->id)
        ->first();
            
        } catch (Exception $e) {
            
        }
        /*$empleado=DB::table('empleado as e')
        ->join('persona as ec','e.identificacion','=','ec.identificacion')
        ->select('e.idempleado','ec.nombre1','ec.apellido1')
        ->where('e.idempleado','=',$id)
        ->first();

        $asignajefe=DB::table('asignajefe as aj')
        ->join('persona as p','aj.identificacion','=','p.identificacion')
        ->join('users as us','p.identificacion','=','us.identificacion')
        ->join('empleado as e','aj.idempleado','=','e.idempleado')
        ->select('aj.idasignajefe','p.nombre1')
        ->where('us.id','=',Auth::user()->id)
        ->first();*/
        return view("listados.empleado.acta",["empleado"=>$empleado,"asignajefe" =>$asignajefe]);
    }
    public function store(HistoriaRequest $request)
    {
        $idem = $request->get('idempleado');
        $idjefe = $request->get('idjefe');
        $fecha=$request->get('fecha');
        $fecha=Carbon::createFromFormat('d/m/Y',$fecha);
        $fecha=$fecha->format('Y-m-d');


        $img=$request->file('adjunto');

        $hta=new Historia;
        $hta-> idempleado=$idem;
        $hta-> fecha=$fecha;
        $hta-> historia=$request->get('motivo');
        $hta-> comentario=$request->get('comentario');
        $hta-> idasignajefe=$idjefe;
        if($img === null)
        {
            $hta-> adjunto="";
        }
        else
        {
            $file_route=time().'_'.$img->getClientOriginalName();
            Storage::disk('adjuntos')->put($file_route, file_get_contents($img->getRealPath() ) );
            $hta-> adjunto=$file_route;    
        }
        $hta->save();
        return view("listados.empleado.index");
    }
    public function laboral($id)
    {
        $historia=DB::table('nomytras as nt')
        ->join('empleado as e','nt.idempleado','=','e.idempleado')
        ->join('afiliado as a','nt.idafiliado','=','a.idafiliado')
        ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
        ->join('caso as c','nt.idcaso','=','c.idcaso')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->select('p.nombre1','p.nombre2','p.apellido1','p.apellido2','a.nombre as naf','pu.nombre as npu','c.nombre as nc','nt.fecha','nt.salario')
        ->where('e.idempleado','=',$id)
        ->get();

        return view('rrhh.empleados.hlaboral',["historia"=>$historia]);
    }

    public function calculardias(request $request, $id)
    {

        $dias =DB::table('vacadetalle as va')
        ->join('empleado as emp','va.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->select('va.idempleado','va.idausencia','va.acuhoras','va.acudias','va.fecharegistro','va.idvacadetalle','va.solhoras','va.soldias') 
        ->where('emp.idempleado','=',$id)
        ->where('va.estado','=','1')
        ->orderBy('va.idvacadetalle','desc')
        ->first();

        $ausencia= DB::table('ausencia as a')
        ->join('empleado as emp','a.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('a.autorizacion')
        ->orderBy('a.idausencia','DESC')
        ->where('idtipoausencia','=','3')
        ->where('U.id','=',$id)
        ->first();

        if($ausencia === null)
        {
          $autorizacion = "ninguno";
        }
        else
        {
          $autorizacion = $ausencia->autorizacion;
        }

        $fecharegistro = $dias->fecharegistro;    
        $diasactual = $dias->acudias;   //obtiene la ultima fecha en donde se registro un nuevo registro
        $horasactual = $dias->acuhoras;
        $diasol = $dias->soldias;
        $horasol = $dias->solhoras;

        $dt = Carbon::parse($fecharegistro);  // convertimos la fecha en el formato Y-mm-dddd h:i:s
        $today = Carbon::now();
        
        $year = $today->format('Y');


        if((($year%4 == 0) && ($year%100)) || $year%400 == 0)
        {$year = 366;}
        else{$year = 365;}

        $ftoday = $today->toDateString();

        
       
        if($fecharegistro >= $ftoday)
        {
          $thoras = $horasactual + $horasol;
          $dias = $diasactual + $diasol; 

           if($thoras >= 8)
          {
            $thoras = $thoras -8;
            $dias = $dias +1;
          }


        }
        else
        {

          $add = $today->dayOfYear;  //obtiene los dias transcurridos hasta la fecha actual
          
          $dias = (strtotime($today)-strtotime($fecharegistro))/86400;
          $dias   = abs($dias); $dias = floor($dias); 
           
          $dias = $dias * 20;

          $dias = $dias / $year;
          $dias = round($dias, 2);


          $tdia = explode(".",$dias);


          $dias = $tdia[0];

          if (empty($tdia[1])) {
            $thoras =0;
            $thoras = $horasactual + $thoras + $horasol;
            $dias = $diasactual + $dias + $diasol; 
          }
          else{ 
            $thoras = $tdia[1];

            $thoras = '0.'.$thoras;
            $thoras = $thoras * 8;

            $thora = explode(".",$thoras);
            $thoras = $thora[0];

            $thoras = $horasactual + $thoras + $horasol;
            $dias = $diasactual + $dias + $diasol; }

            if($thoras >= 8)
            {
              $thoras = $thoras -8;
              $dias = $dias +1;
            }      
          }

        $calculo = array($thoras,$dias,$autorizacion);
        return response()->json($calculo);
    }

    public function indexsolicitado(Request $request)
    {

        $vacaciones = DB::table('ausencia as au')
        ->join('empleado as emp','au.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
        ->join('vacadetalle as v','au.idausencia','=','v.idausencia')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia','au.totaldias','au.totalhoras','v.soldias','v.solhoras','au.justificacion')
        ->where('au.autorizacion','=','solicitado')
        ->where('tp.idtipoausencia','=','3')
        ->orderBy('au.fechasolicitud','desc')        
        ->paginate(15); 

        return view('listados.vacaciones.index',["vacaciones"=>$vacaciones]);        
    }

    public function indexconfirmado(Request $request)
    {

        $vacaciones = DB::table('ausencia as au')
        ->join('empleado as emp','au.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
        ->join('users as U','au.id','=','U.id')
        ->join('vacadetalle as v','au.idausencia','=','v.idausencia')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia','U.name','au.totaldias','au.totalhoras','v.soldias','v.solhoras','au.justificacion','au.observaciones')
        ->where('au.autorizacion','=','Confirmado')
        ->where('tp.idtipoausencia','=','3')
        ->orderBy('au.fechasolicitud','desc')        
        ->paginate(15);  

        return view('listados.vacaciones.indexconfirmado',["vacaciones"=>$vacaciones]);        
    }

    public function indexrechazado (Request $request)
    {
        $vacaciones = DB::table('ausencia as au')
            ->join('empleado as emp','au.idempleado','=','emp.idempleado')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
            ->join('users as U','au.id','=','U.id')
            ->join('vacadetalle as v','au.idausencia','=','v.idausencia')
            ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia','U.name','au.totaldias','au.totalhoras','v.soldias','v.solhoras','au.justificacion','au.observaciones')
            ->where('au.autorizacion','=','Rechazado')
            ->where('tp.idtipoausencia','=','3')
            ->orderBy('au.fechasolicitud','desc')        
            ->paginate(15);  
        return view('listados.vacaciones.indexrechazado',["vacaciones"=>$vacaciones]);        
    }

    public function indexautorizado (Request $request)
    {
        $vacaciones = DB::table('ausencia as au')
            ->join('empleado as emp','au.idempleado','=','emp.idempleado')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
            ->join('users as U','au.id','=','U.id')
            ->join('vacadetalle as v','au.idausencia','=','v.idausencia')
            ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia','U.name','au.totaldias','au.totalhoras','v.soldias','v.solhoras','au.justificacion','au.observaciones')
            ->where('au.autorizacion','=','Autorizado')
            ->where('tp.idtipoausencia','=','3')
            ->orderBy('au.fechasolicitud','desc')        
            ->paginate(15);

        return view('rrhh.permisosvacaciones.indexautorizado',["vacaciones"=>$vacaciones]);        
    }


    // Funciones de despido
        public function bajas(request $request,$id)
        {
            $empleado = DB::table('empleado as em')
            ->join('persona as per','per.identificacion','=','em.identificacion')
            ->where('em.idempleado','=', $id)
            ->select('per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','per.apellido3','em.idempleado','em.identificacion')
            ->first();
            return response()->json($empleado);
        }

        public function addbaja(request $request)
        {
            $this->validateRequest($request);

            try 
            {
                DB::beginTransaction();

                $idempleado = $request->idempleado;
                $identificacion = $request->identificacion;
                $fechabaja = $request->fecha_despido;
                $motivo = $request->motivo;
                $comentarios = $request->observaciones;
                $idstatus = $request->idstatus;

                $fechabaja = Carbon::createFromFormat('d/m/Y',$fechabaja);
                $fechabaja = $fechabaja->toDateString();
                $bajas = new Bajas;
                
                $bajas->fechabaja = $fechabaja;
                $bajas->motivo = $motivo;
                $bajas->comentarios = $comentarios;
                $mytime = Carbon::now('America/Guatemala');
                $bajas->fechasistema=$mytime->toDateString();
                $bajas->idempleado=$idempleado;
                
                $bajas->save();

                $empleado = empleado::find($idempleado);
                $empleado->idstatus = $idstatus;
                $empleado->save();

                $idusario = DB::table('users as U')
                ->join('persona as p','U.identificacion','=','p.identificacion')
                ->select('U.id')
                ->where('U.identificacion','=',$identificacion)
                ->first();

                $usuario = user::find($idusario->id);
                //$usuario->password=bcrypt('brcsolera12072017');
                $usuario->password=bcrypt('DespidoATM');
                $usuario->estado = 0;
                $usuario->save();

                DB::commit();
                
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(array('error' => 'No se ha podido realizar la solicitud de despido'),404);      
            }

            return response()->json($bajas);
        }

        public function validateRequest($request){
            $rules=[
              'fecha_despido'=>'required',
              'observaciones'=>'required|max:300',


            ];
            $messages=[
            'required' => 'Debe ingresar :attribute.',
            'max'  => 'La capacidad del campo :attribute es :max',
            ];
            $this->validate($request, $rules,$messages);        
        }


        public function debaja(request $request)
        {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $empleado=DB::table('empleado as e')
            ->join('status as st','e.idstatus','=','st.idstatus')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('nomytras as nt','e.idempleado','=','nt.idempleado')
            ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
            ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
            ->select('e.idempleado','e.identificacion','e.nit','e.afiliacionigss','e.numerodependientes','e.aportemensual','e.vivienda','e.alquilermensual','e.otrosingresos','p.nombre1','p.nombre2','p.apellido1','p.apellido2','st.statusemp as statusn','pu.nombre as puesto','af.nombre as afiliado',DB::raw('max(nt.idnomytas) as idnomytas'))
            ->where('e.idstatus','=',5)
            ->orwhere('e.idstatus','=',4)
            ->groupBy('e.idempleado')      
            ->orderBy('e.idempleado','desc')
            ->paginate(20);
        }
        return view('rrhh.empleados.debaja',["empleado"=>$empleado,"searchText"=>$query]);    
        }

}
/*
->where('empleado.idstatus','!=', 5)
        ->groupBy('empleado.idempleado')      
        ->orderBy('empleado.idempleado','desc')
        ->paginate(20);*/