<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\EmpleadoFormRequest;
use App\Empleado;
use App\Persona;
use DB;
use PDF;
use DateTime;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Constants;

class RHReclutamiento extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listadoR(Request $request)
    {
        
        return view('rrhh.reclutamiento.index');
    }
    public function pdf()
    {
        $empleados = Persona::all();
        $pdf= PDF::loadView('empleado.solicitante.pdf',['empleados' => $empleados]);
        return $pdf->download('empleados.pdf');
    }
    public function Spdf($id)
    {
        $persona=DB::table('persona as p')
        ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
        ->join('departamento as dp','m.iddepartamento','=','dp.iddepartamento')
        ->join('empleado as em','p.identificacion','=','em.identificacion')
        ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
        ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
        ->select('p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.telefono','p.celular','p.fechanac','p.avenida','p.calle','p.nomenclatura','p.zona','p.barriocolonia','dp.nombre as departamento','m.nombre as municipio','a.nombre as afiliado','pu.nombre as puesto')
        ->where('em.identificacion','=',$id)
        ->first();



        $fedad = new DateTime($persona->fechanac);
        
        $month = $fedad->format('m');
        $day = $fedad->format('d');
        $year = $fedad->format('Y');
        $fnac = Carbon::createFromDate($year,$month,$day)->age;


        $empleado=DB::table('empleado as e')
        ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
        ->select('e.identificacion','e.afiliacionigss','e.numerodependientes','e.aportemensual','e.vivienda','e.alquilermensual','e.otrosingresos','e.pretension','e.nit','e.fechasolicitud','ec.estado as estadocivil')
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

        $factual = Carbon::now('America/Guatemala');
        $factual = $factual->format('d-m-Y h:i A'); 
        //$factual = $factual->toDateTimeString();
        /*
        return view ('empleado.solicitante.pdf',["persona"=>$persona,"empleado"=>$empleado,"academicos"=>$academicos,"experiencias"=>$experiencias,"familiares"=>$familiares,"idiomas"=>$idiomas,"referencias"=>$referencias,"deudas"=>$deudas,"padecimientos"=>$padecimientos,"factual"=>$factual,"fnac"=>$fnac]);
        */
        
        $pdf= PDF::loadView('empleado.solicitante.pdf',["persona"=>$persona,"empleado"=>$empleado,"academicos"=>$academicos,"experiencias"=>$experiencias,"familiares"=>$familiares,"idiomas"=>$idiomas,"referencias"=>$referencias,"deudas"=>$deudas,"padecimientos"=>$padecimientos,"factual"=>$factual,"fnac"=>$fnac]);
        return $pdf->download('solicitante.pdf');        
    }
    public function index(Request $request)
    {
        if($request)
            {
            //$dato=$request;
            $dato=trim($request->get('dato_buscado'));
            //dd($query);
            $empleados=DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
            ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
            ->join('afiliado as af','p.idafiliado','=','af.idafiliado')
            ->join('status as s','e.idstatus','=','s.idstatus')
            ->select('e.idempleado','e.identificacion','e.nit','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','ec.estado as estadocivil','s.idstatus','s.statusemp as status','pu.nombre as puesto','af.nombre as afnombre')
            
            //->where('p.apellido1','LIKE','%'.$query.'%')

            ->where('s.statusemp','=','Aspirante'  )
            ->orwhere('s.statusemp','=','Solicitante Interno')

            //->where('p.nombre1','LIKE','%'.$query.'%')
            //->orwhere('p.apellido1','LIKE','%'.$query.'%')

            ->groupBy('e.idempleado','e.identificacion','e.nit','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','ec.estado','s.statusemp','pu.nombre','af.nombre')
            ->orderBy('e.fechasolicitud','desc')
            ->paginate(19);

            $var='1';
            return view('rrhh.reclutamiento.solicitud',["empleados"=>$empleados,"dato"=>$dato,"var"=>$var]);
            }
    }
    public function indexjf(Request $request)
    {
        $query=trim($request->get('searchText'));
        $perosna=new Persona;
        /*$empleados = $perosna->selectQuery(Constants::listadoindex,array(Auth::user()->id));*/
        //$area=DB::table('area')->get();
        $empleados =DB::select("call pcsolicitud(?)",array(Auth::user()->id));
        //dd($empleados);
        $var='7';
        return view('rrhh.jfreclutamiento.solicitudjf',["empleados"=>$empleados,"searchText"=>$query,"var"=>$var]);
    }
    public function busquedas($dato="")
    {
        $empleados= Persona::Solicitante($dato)->join('empleado as e','e.identificacion','=','persona.identificacion')
            ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
            ->join('puesto as pu','persona.idpuesto','=','pu.idpuesto')
            ->join('afiliado as af','persona.idafiliado','=','af.idafiliado')
            ->join('status as s','e.idstatus','=','s.idstatus')
            ->select('e.idempleado','e.identificacion','e.nit','persona.nombre1','persona.nombre2','persona.nombre3','persona.apellido1','persona.apellido2','ec.estado as estadocivil','s.idstatus','s.statusemp as status','pu.nombre as puesto','af.nombre as afnombre')
            ->where('s.statusemp','=','Aspirante'  )
            ->orwhere('s.statusemp','=','Solicitante Interno')
            ->groupBy('e.idempleado','e.identificacion','e.nit','persona.nombre1','persona.nombre2','persona.nombre3','persona.apellido1','persona.apellido2','ec.estado','s.statusemp','pu.nombre','af.nombre')
            ->orderBy('e.idempleado','desc')
            ->paginate(19);
        $var='1';
        return view('rrhh.reclutamiento.indexb',["empleados"=>$empleados,"dato"=>$dato,"var"=>$var]);        
    }
    public function rechazo($idE,$idS)
    {
        if ($idS=="12") {
            $st=Empleado::find($idE);
            $st-> idstatus='2';
            $st->update();
        }
        if ($idS=="1") {
            $st=Empleado::find($idE);
            $st-> idstatus='10';
            $st->update();
        }
        //return view('rrhh.reclutamiento.index');
        return Redirect::to('empleado/listadoR');
    }
    public function rechazoPP($idE)
    {

        $st=Empleado::find($idE);
        $st-> idstatus='10';
        $st->update();
        return Redirect::to('listados/pprueba');
    }
    public function rechazoPI($idE)
    {

        $st=Empleado::find($idE);
        $st-> idstatus='10';
        $st->update();
        return Redirect::to('listados/interino');
    }
    public function upt (Request $request)
    {
        $id = $request->get('idempleado');

        $od=Empleado::findOrFail($id);
        $od-> observacion=$request->get('observacion');
        $od->save();
        return response()->json($od);
    }
 
}