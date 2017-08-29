<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\EmpleadoFormRequest;
use App\Empleado;
use App\Persona;
use App\Entrevista;
use App\Academico;
use App\Experiencia;
use DB;
use PDF;
use DateTime;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Constants;

class RHPreentrevista extends Controller
{
    public function upPreentrevista ($id,$ids)
    {
        //dd($ids);
        $od=Empleado::find($id);
        $od-> idstatus = '13';
        $od->update();

        $ent = new Entrevista;
        $ent-> lugar="";
        $ent-> perentrevista = $ids;
        $ent->save();
        //dd($id);
        return Redirect::to('empleado/listadoR');
    }
    /*public function upPreentrevistajf ($id,$ids)
    {
        $od=Empleado::find($id);
        $od-> idstatus = '13';
        $od->update();

        $ent = new Entrevista;
        $ent-> lugar="";
        $ent-> perentrevista = $ids;
        $ent->save();
        return Redirect::to('empleado/solicitudesjf');
    }*/
    public static function  getTowns(Request $request, $id)
    {
            if ($request->ajax())
            {
                $towns = DB::table('departamento as depa')
                ->join('municipio as muni','depa.iddepartamento','=','muni.iddepartamento')
                ->select ('muni.idmunicipio','muni.nombre')
                ->where('muni.iddepartamento','=',$id)
                ->get();
                return response()->json($towns);
            }
    }
    public function preentre ($id)
    {
    	$persona=DB::table('persona as p')
        ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
        ->join('departamento as dp','m.iddepartamento','=','dp.iddepartamento')
        ->join('empleado as em','p.identificacion','=','em.identificacion')
        ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
        ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
        ->join('estadocivil as ec','em.idcivil','=','ec.idcivil')
        ->select('em.idempleado','p.identificacion','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.telefono','p.celular','p.fechanac','p.barriocolonia','dp.nombre as departamento','m.nombre as municipio','a.nombre as afiliado','pu.nombre as puesto','p.finiquitoive','ec.estado as ecivil','ec.idcivil','em.vivienda')
        ->where('em.idempleado','=',$id)
        ->first();

        /*$ntitulo=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.identificacion','=','p.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select(DB::raw('max(na.idnivel) as idnivel'),'p.identificacion')
        ->where('em.idempleado','=',$id)
        ->where('na.mintrabna','=',1)
        ->first();


        $academico=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.identificacion','=','p.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select('na.idnivel','p.identificacion','pa.titulo')
        ->where('em.idempleado','=',$id)
        ->where('na.idnivel','=',$ntitulo->idnivel)
        ->where('na.mintrabna','=',1)
        ->first();*/

        $ntitulo=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.identificacion','=','p.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select(DB::raw('max(na.idnivel) as idnivel'),'p.identificacion')
        ->where('em.idempleado','=',$id)
        ->where('na.mintrabna','=',1)
        ->first();

        $deuda=DB::table('personadeudas as pd')
        ->join('empleado as p','pd.idempleado','=','p.idempleado')
        ->select('pd.idpdeudas','pd.acreedor','pd.amortizacionmensual as pago','pd.montodeuda','pd.motivodeuda')
        ->where('p.idempleado','=',$id)
        ->get();

        $academico=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.identificacion','=','p.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select('na.idnivel','p.identificacion','pa.titulo')
        ->where('na.idnivel','=',$ntitulo->idnivel)
        ->where('em.idempleado','=',$id)
        ->where('na.mintrabna','=',1)
        //->groupBy('p.identificacion','na.idnivel')
        ->first();

        $licencias=DB::table('empleado as em')
        ->join('persona as p','em.identificacion','=','p.identificacion')
        ->join('personalicencia as pl','p.identificacion','=','pl.identificacion')
        ->join('licencia as l','pl.idlicencia','=','l.idlicencia')
        ->select('l.tipolicencia')
        ->where('em.idempleado','=',$id)
        ->get();

        $hermanos=DB::table('persona as p')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->join('empleado as emp','emp.idempleado','pf.idempleado')
        ->select(DB::raw('count(pf.parentezco) as hermano'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hermano')
        //->where('emp.idempleado','=',$id)
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();

        $esposa=DB::table('persona as p')
        ->join('empleado as em','p.identificacion','=','em.identificacion')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->select('pf.ocupacion','pf.parentezco')
        ->where('pf.parentezco','=','Conyuge')
        ->where('em.idempleado','=',$id)
        ->first();


        $hijo=DB::table('persona as p')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->join('empleado as emp','emp.idempleado','pf.idempleado')
        ->select(DB::raw('count(pf.parentezco) as hijos'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hijo')
        //->where('emp.idempleado','=',$id)
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();

        $entre=DB::table('persona as p')
        ->join('empleado as e','e.identificacion','=','p.identificacion')
        ->join('entrevista as en','en.perentrevista','=','p.identificacion')
        ->select('en.identrevista','en.fechaentre','en.lugar','en.aportefamilia','en.cargasfamiliares','en.mcorto','en.mmediano','en.mlargo','en.descpersonal','en.trabajoequipo','en.bajopresion','en.atencionpublico','en.ordenado','en.presentacion','en.disponibilidad','en.dispoviajar','en.dispfinsemana','en.comunicar','en.pretensionminima','en.entrevistadores','en.perentrevista','en.vivecompania','en.puntual','en.dedicanpadres')
        ->where('e.idempleado','=',$id)
        ->first();

        //dd($entre);
        $date = Carbon::now('America/Guatemala');
        $date = $date->format('d-m-Y');

        $fedad = new DateTime($persona->fechanac);
        $month = $fedad->format('m');
        $day = $fedad->format('d');
        $year = $fedad->format('Y');
        $fnac = Carbon::createFromDate($year,$month,$day)->age;

        $departamento=DB::table('departamento')->get();
        $nivelacademico = DB::table('nivelacademico')->get();
        $pais=DB::table('pais')->get();
        $academicoIns = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('personaacademico as pa','e.identificacion','=','pa.identificacion')
            ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
            ->select('e.idempleado','p.identificacion','pa.idpacademico','pa.titulo','pa.establecimiento','pa.duracion','pa.fingreso','pa.fsalida','pa.idmunicipio','pa.identificacion','pa.idnivel','pa.periodo','na.nombrena')
            ->where('e.idempleado','=',$id)
            ->get();

        $experiencia = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('personaexperiencia as pe','e.identificacion','=','pe.identificacion')
            ->select('e.idempleado','p.identificacion','pe.idpexperiencia','pe.empresa','pe.puesto','pe.jefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex')
            ->where('e.idempleado','=',$id)
            ->get();


        return view('rrhh.reclutamiento.preentrevistar',["persona"=>$persona,"date"=>$date,"fnac"=>$fnac,"academico"=>$academico,"licencias"=>$licencias,"nivelacademico"=>$nivelacademico,"academicoIns"=>$academicoIns,'pais'=>$pais,'departamento'=>$departamento,"experiencia"=>$experiencia,"hermanos"=>$hermanos,"hijo"=>$hijo,'esposa'=>$esposa,"entre"=>$entre,"deuda"=>$deuda]);
    }
    public function listadopreE (Request $request)
    {
    	if($request)
        {
            $query=trim($request->get('searchText'));
            $empleados=DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
            ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
            ->join('afiliado as af','p.idafiliado','=','af.idafiliado')
            ->join('status as s','e.idstatus','=','s.idstatus')
            ->select('e.idempleado','e.identificacion','e.nit','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','ec.estado as estadocivil','s.idstatus','s.statusemp as status','pu.nombre as puesto','af.nombre as afnombre')
            //->where('p.nombre1','LIKE','%'.$query.'%')
            //->andwhere('p.apellido1','LIKE','%'.$query.'%')
            ->where('e.idstatus','=',13)

            ->where('p.nombre1','LIKE','%'.$query.'%')
            //->orwhere('p.apellido1','LIKE','%'.$query.'%')

            ->groupBy('e.idempleado','e.identificacion','e.nit','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','ec.estado','s.statusemp','pu.nombre','af.nombre')
            ->orderBy('e.idempleado','desc')
            
            ->paginate(19);
            }
            return view('rrhh.preentrevista.listadoPE',["empleados"=>$empleados,"searchText"=>$query]);	
    }
    public function prelistadojf(Request $request)
    {
        $query=trim($request->get('searchText'));
        $perosna=new Persona;
        //$empleados = $perosna->selectQuery(Constants::listadopreentrevistadosji,array(Auth::user()->id));

        $empleados =DB::select("call pcsolicitudpe(?)",array(Auth::user()->id));
        return view('rrhh.jfreclutamiento.solicitudjfpre',["empleados"=>$empleados,"searchText"=>$query]);
    }
    public function prentrevista (Request $request)
    {
        $iden=$request->get("identrevista");
        //dd($iden);
        $entre = Entrevista::findOrFail($iden);
    	$entre-> perentrevista = $request->get('identificacion');

        $fechanacs=$request->get('fechaentre');
        $fechanacc=Carbon::createFromFormat('d-m-Y',$fechanacs);
        $fecha=$fechanacc->format('Y-m-d');

        $entre-> fechaentre = $fecha;
        $entre-> vivecompania = $request->get("vivecompania");
        $entre-> aportefamilia = $request->get("aportefamilia");
        $entre-> mcorto = $request->get("mcorto");
        $entre-> mmediano = $request->get("mmediano");
        $entre-> mlargo = $request->get("mlargo");
        $entre-> descpersonal = $request->get("descpersonal");
        $entre-> trabajoequipo = $request->get("trabajoequipo");
        $entre-> bajopresion = $request->get("bajopresion");
        $entre-> atencionpublico = $request->get("atencionpublico");
        $entre-> ordenado = $request->get("ordenado");
        $entre-> entrevistadores = $request->get("entrevistadores");
        $entre-> puntual=$request->get("puntual");
        $entre-> presentacion=$request->get("presentacion");
        $entre-> disponibilidad=$request->get("disponibilidad");
        $entre-> dispfinsemana=$request->get("dispfinsemana");
        $entre-> dispoviajar=$request->get("dispoviajar");
        $entre-> bajopresion=$request->get("bajopresion");
        $entre-> pretensionminima=$request->get("pretensionminima");
        $entre-> dedicanpadres=$request->get("dedicanpadres");
        $entre-> lugar=$request->get("lugar");
        $entre-> comunicar=$request->get("comunicar");
        $entre-> save();

        return response()->json($entre);
    }
    public function adicionalacad(Request $request)
    {
            $this->validateRequest($request);
            $idpais = $request->get('idpais');

            $academico = new Academico;

            $fechaingreso = $request->fecha_ingreso; 
            $fechasalida = $request->fecha_salida;


            $fechaingreso = Carbon::createFromFormat('d/m/Y',$fechaingreso);
            $fechasalida = Carbon::createFromFormat('d/m/Y',$fechasalida);

            $fechaingreso = $fechaingreso->toDateString();
            $fechasalida = $fechasalida->toDateString();

            $academico->titulo = $request->get('titulo');
            $academico->establecimiento = $request->get('establecimiento');
            $academico->duracion = $request->get('duracion');
            $academico->fingreso = $fechaingreso;
            $academico->fsalida = $fechasalida;

            /*$academico->idpais = $request->get('idpais');
            $academico->idmunicipio = $request->get('idmunicipio');*/

            if ($idpais ==="73") 
            {
                $academico->idpais = $idpais;
                $academico->idmunicipio = $request->get('idmunicipio');
            }
            else
            {
                   //$academicos-> idmunicipio = NULL;
                $academico->idpais = $idpais;
            }


            $academico->idempleado = $request->get('idempleado');
            $academico->identificacion = $request->get('identificacion');
            $academico->idnivel = $request->get('idnivel');
            $academico->periodo = $request->get('periodo');

            //$data = $request->toArray();
            //$academico = Academico::create($data);
            $academico->save();
                    
            return response()->json($academico);
    }
    public function validateRequest($request)
    {
            $rules=[
            'titulo' => 'required|max:100',
            'establecimiento' => 'required|max:100',
            'duracion'=> 'required|max:2',
            'fecha_salida'=>'required',
            'fecha_ingreso'=>'required',


            ];
            $messages=[
            'required' => 'Debe ingresar :attribute.',
            'max'  => 'La capacidad del campo :attribute es :max',
            ];
            $this->validate($request, $rules,$messages);        
    }
    public function agregarexperiencia(Request $request)
    {
            $this->validateRequestE($request);
            $familia = new Experiencia;
            $familia->empresa = $request->get('empresa');
            $familia->puesto = $request->get('puesto');
            $familia->jefeinmediato = $request->get('jefeinmediato');
            $familia->motivoretiro = $request->get('motivoretiro');
            $familia->ultimosalario = $request->get('ultimosalario');
            $familia->fingresoex = $request->get('año_ingreso');
            $familia->fsalidaex = $request->get('año_salida');
            $familia->idempleado = $request->get('idempleado');
            $familia->identificacion = $request->get('identificacion');

            $familia->save();

            return response()->json($familia);
    }
    public function validateRequestE($request)
    {
            $rules=[
            'empresa' => 'required|max:100',
            'puesto' => 'required|max:50',
            'jefeinmediato' => 'required|max:50',
            'motivoretiro' => 'required|max:40',
            'ultimosalario' => 'required|max:10',
            'año_ingreso' => 'required|max:4',
            'año_salida' => 'required|max:4',


            ];
            $messages=[
            'required' => 'Debe ingresar :attribute.',
            'max'  => 'La capacidad del campo :attribute es :max',
            ];
            $this->validate($request, $rules,$messages);        
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


        return view('rrhh.preentrevista.show',["persona"=>$persona,"empleado"=>$empleado,"academicos"=>$academicos,"experiencias"=>$experiencias,"familiares"=>$familiares,"idiomas"=>$idiomas,"referencias"=>$referencias,"deudas"=>$deudas,"padecimientos"=>$padecimientos,"pais"=>$pais,"pariente"=>$pariente,"nivelacademico"=>$nivelacademico,"estadocivil"=>$estadocivil,"observaciones"=>$observaciones,'entrev'=>$entrev,"observaR"=>$observaR,"observaE"=>$observaE]);
    }
    public function PDFpre ($id)
    {
        $persona=DB::table('persona as p')
        ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
        ->join('departamento as dp','m.iddepartamento','=','dp.iddepartamento')
        ->join('empleado as em','p.identificacion','=','em.identificacion')
        ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
        ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
        ->join('estadocivil as ec','em.idcivil','=','ec.idcivil')
        ->select('em.idempleado','p.identificacion','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.telefono','p.celular','p.fechanac','p.barriocolonia','dp.nombre as departamento','m.nombre as municipio','a.nombre as afiliado','pu.nombre as puesto','p.finiquitoive','ec.estado as ecivil','ec.idcivil','em.vivienda')
        ->where('em.idempleado','=',$id)
        ->first();

        $ntitulo=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.idempleado','=','pa.idempleado')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select(DB::raw('max(na.idnivel) as idnivel'),'p.identificacion')
        ->where('em.idempleado','=',$id)
        ->where('na.mintrabna','=',1)
        ->first();


        $academico=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.idempleado','=','pa.idempleado')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select('na.idnivel','p.identificacion','pa.titulo')
        ->where('na.idnivel','=',$ntitulo->idnivel)
        ->where('na.mintrabna','=',1)
        ->first();

        $deuda=DB::table('personadeudas as pd')
        ->join('empleado as p','pd.idempleado','=','p.idempleado')
        ->select('pd.idpdeudas','pd.acreedor','pd.amortizacionmensual as pago','pd.montodeuda','pd.motivodeuda')
        ->where('p.idempleado','=',$id)
        ->get();
        
        $licencias=DB::table('empleado as em')
        ->join('persona as p','em.identificacion','=','p.identificacion')
        ->join('personalicencia as pl','p.identificacion','=','pl.identificacion')
        ->join('licencia as l','pl.idlicencia','=','l.idlicencia')
        ->select('l.tipolicencia')
        ->where('em.idempleado','=',$id)
        ->get();

        $hermanos=DB::table('persona as p')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->join('empleado as emp','emp.idempleado','pf.idempleado')
        ->select(DB::raw('count(pf.parentezco) as hermano'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hermano')
        //->where('emp.idempleado','=',$id)
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();

        $esposa=DB::table('persona as p')
        ->join('empleado as em','p.identificacion','=','em.identificacion')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->select('pf.ocupacion','pf.parentezco')
        ->where('pf.parentezco','=','Conyuge')
        ->where('em.idempleado','=',$id)
        ->first();


        $hijo=DB::table('persona as p')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->join('empleado as emp','emp.idempleado','pf.idempleado')
        ->select(DB::raw('count(pf.parentezco) as hijos'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hijo')
        //->where('emp.idempleado','=',$id)
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();

        $entre=DB::table('persona as p')
        ->join('empleado as e','e.identificacion','=','p.identificacion')
        ->join('entrevista as en','en.perentrevista','=','p.identificacion')
        ->select('en.identrevista','en.fechaentre','en.lugar','en.aportefamilia','en.cargasfamiliares','en.mcorto','en.mmediano','en.mlargo','en.descpersonal','en.trabajoequipo','en.bajopresion','en.atencionpublico','en.ordenado','en.presentacion','en.disponibilidad','en.dispoviajar','en.dispfinsemana','en.comunicar','en.pretensionminima','en.entrevistadores','en.perentrevista','en.vivecompania','en.puntual','en.dedicanpadres')
        ->where('e.idempleado','=',$id)
        ->first();

        //dd($entre);
        $date = Carbon::now('America/Guatemala');
        $date = $date->format('d-m-Y');

        $fedad = new DateTime($persona->fechanac);
        $month = $fedad->format('m');
        $day = $fedad->format('d');
        $year = $fedad->format('Y');
        $fnac = Carbon::createFromDate($year,$month,$day)->age;

        $departamento=DB::table('departamento')->get();
        $nivelacademico = DB::table('nivelacademico')->get();
        $pais=DB::table('pais')->get();
        $academicoIns = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('personaacademico as pa','e.identificacion','=','pa.identificacion')
            ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
            ->select('e.idempleado','p.identificacion','pa.idpacademico','pa.titulo','pa.establecimiento','pa.duracion','pa.fingreso','pa.fsalida','pa.idmunicipio','pa.identificacion','pa.idnivel','pa.periodo','na.nombrena')
            ->where('e.idempleado','=',$id)
            ->get();

        $experiencia = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('personaexperiencia as pe','e.identificacion','=','pe.identificacion')
            ->select('e.idempleado','p.identificacion','pe.idpexperiencia','pe.empresa','pe.puesto','pe.jefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex')
            ->where('e.idempleado','=',$id)
            ->get();


        $pdf= PDF::loadView('rrhh.preentrevista.pdfpentre',["persona"=>$persona,"date"=>$date,"fnac"=>$fnac,"academico"=>$academico,"licencias"=>$licencias,"nivelacademico"=>$nivelacademico,"academicoIns"=>$academicoIns,'pais'=>$pais,'departamento'=>$departamento,"experiencia"=>$experiencia,"hermanos"=>$hermanos,"hijo"=>$hijo,'esposa'=>$esposa,"entre"=>$entre,"deuda"=>$deuda]);
        return $pdf->download('Pre-Entrevista.pdf'); 
    }

    public function showprejf($id)
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


        return view('rrhh.jfreclutamiento.showjfpre',["persona"=>$persona,"empleado"=>$empleado,"academicos"=>$academicos,"experiencias"=>$experiencias,"familiares"=>$familiares,"idiomas"=>$idiomas,"referencias"=>$referencias,"deudas"=>$deudas,"padecimientos"=>$padecimientos,"pais"=>$pais,"pariente"=>$pariente,"nivelacademico"=>$nivelacademico,"estadocivil"=>$estadocivil,"observaciones"=>$observaciones,'entrev'=>$entrev,"observaR"=>$observaR,"observaE"=>$observaE]);
    }
}

