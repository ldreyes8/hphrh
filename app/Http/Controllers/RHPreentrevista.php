<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\EmpleadoFormRequest;
use App\Empleado;
use App\Persona;
use App\Entrevista;
use DB;
use PDF;
use DateTime;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;

class RHPreentrevista extends Controller
{
    public function upPrecalificado ($id)
    {
   		

        $od=Empleado::findOrFail($id);
        $od-> idstatus='14';
        $od->update();

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

		return view('rrhh.reclutamiento.precalificar',["persona"=>$persona,"date"=>$date,"fnac"=>$fnac,"academico"=>$academico,"licencias"=>$licencias]);
    }

    public function listadopreE ()
    {
    	
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
        $entre-> save();
    }
}
