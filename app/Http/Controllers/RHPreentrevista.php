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

class RHPreentrevista extends Controller
{
    public function upPreentrevista ($id)
    {
        $od=Empleado::findOrFail($id);
        $od-> idstatus='13';
        $od->update();
        return Redirect::to('empleado/solicitudes');
    }
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

        $licencias=DB::table('empleado as em')
        ->join('persona as p','em.identificacion','=','p.identificacion')
        ->join('personalicencia as pl','p.identificacion','=','pl.identificacion')
        ->join('licencia as l','pl.idlicencia','=','l.idlicencia')
        ->select('l.tipolicencia')
        ->where('em.idempleado','=',$id)
        ->get();

        $hermanos=DB::table('persona as p')
        ->join('empleado as em','p.identificacion','=','em.identificacion')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->select(DB::raw('count(pf.parentezco) as hijos'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hermano')
        ->where('em.idempleado','=',$id)
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();


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


		return view('rrhh.reclutamiento.preentrevistar',["persona"=>$persona,"date"=>$date,"fnac"=>$fnac,"academico"=>$academico,"licencias"=>$licencias,"nivelacademico"=>$nivelacademico,"academicoIns"=>$academicoIns,'pais'=>$pais,'departamento'=>$departamento,"experiencia"=>$experiencia]);
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
    public function prentrevista (Request $request)
    {
        $entre = new Entrevista;
    	$entre-> perentrevista = $request->get('identificacion');

        $fechanacs=$request->get('fechaentre');
        $fechanacc=Carbon::createFromFormat('d-m-Y',$fechanacs);
        $fecha=$fechanacc->format('Y-m-d');

        $entre-> fechaentre = $fecha;
        $entre-> vivecompania = $request->get("vivecompania");
        $entre-> mcorto = $request->get("mcorto");
        $entre-> mmediano = $request->get("mmediano");
        $entre-> mlargo = $request->get("mlargo");
        $entre-> descpersonal = $request->get("descpersonal");
        $entre-> trabajoequipo = $request->get("trabajoequipo");
        $entre-> bajopresion = $request->get("bajopresion");
        $entre-> atencionpublico = $request->get("atencionpublico");
        $entre-> ordenado = $request->get("ordenado");
        $entre-> entrevistadores = $request->get("entrevistadores");
        $entre-> puntual=$request->get("#puntual");
        $entre-> presentacion=$request->get("#presentacion");
        $entre-> disponibilidad=$request->get("#disponibilidad");
        $entre-> dispfinsemana=$request->get("#dispfinsemana");
        $entre-> dispoviajar=$request->get("#dispoviajar");
        $entre-> bajopresion=$request->get("#bajopresion");
        $entre-> pretensionminima=$request->get("#pretensionminima");
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
}
