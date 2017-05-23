<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Storage;
use DB;
use Carbon\Carbon; //para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Historia;

use App\Http\Requests\HistoriaRequest;
use App\Empleado;
use App\Persona;

class ListadoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index (Request $request)
    {
    	if ($request)
    	{
        $query=trim($request->get('searchText'));
        $empleado=DB::table('empleado as e')
        ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
        ->join('status as st','e.idstatus','=','st.idstatus')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->select('e.idempleado','e.identificacion','e.nit','e.afiliacionigss','e.numerodependientes','e.aportemensual','e.vivienda','e.alquilermensual','e.otrosingresos','ec.estado as estadocivil','p.nombre1 as nombre','p.apellido1 as apellido','st.statusemp as statusn')
        ->where('e.idstatus','=',2)
        ->where('p.nombre1','LIKE','%'.$query.'%')
        ->orderBy('e.idempleado','asc')
        //->orderBy('e.idempleado','desc')
         ->paginate(19);
         /*

        $query=trim($request->get('searchText'));
        $empleado=DB::table('empleado as e')
        ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
        ->join('status as st','e.idstatus','=','st.idstatus')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('nomytras as nt','e.idempleado','=','nt.idempleado')
        ->join('puesto as po','nt.idpuesto','=','po.idpuesto')
        ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
        ->select('e.idempleado','e.identificacion','e.nit','p.nombre1 as nombre','p.apellido1 as apellido','st.statusemp as statusn','po.nombre as npo','af.nombre as naf')
        ->where('e.idstatus','=',2)
        ->where('p.nombre1','LIKE','%'.$query.'%')
        ->orderBy('e.idempleado','asc')
        //->orderBy('e.idempleado','desc')
         ->paginate(19);*/
        }

        return view('listados.empleado.index',["empleado"=>$empleado,"searchText"=>$query]);
    }
    public function show ($id)
    {
        $persona=DB::table('persona as p')
        ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
        ->join('departamento as dp','m.iddepartamento','=','dp.iddepartamento')
        ->join('empleado as em','p.identificacion','=','em.identificacion')
        ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
        ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
        ->select('p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.telefono','p.fechanac','p.avenida','p.calle','p.nomenclatura','p.zona','p.barriocolonia','dp.nombre as departamento','m.nombre as municipio','a.nombre as afiliado','pu.nombre as puesto')
        ->where('em.identificacion','=',$id)
        ->first();

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
        ->select('pf.nombref','pf.apellidof','pf.telefonof','pf.parentezco','pf.ocupacion','pf.edad')
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
        return view('listados.empleado.show',["persona"=>$persona,"empleado"=>$empleado,"academicos"=>$academicos,"experiencias"=>$experiencias,"familiares"=>$familiares,"idiomas"=>$idiomas,"referencias"=>$referencias,"deudas"=>$deudas,"padecimientos"=>$padecimientos]);
        //return view('listados.empleado.show',["empleado"=>$empleado]);
    } 

    public function historial ($id)
    {
        

        $historia=DB::table('historia as h')
        //->join('persona as p','h.identificacion','=','p.identificacion')
        ->join('empleado as e','h.idempleado','=','e.idempleado')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('asignajefe as aj','h.idasignajefe','=','aj.idasignajefe')
        ->select('h.idempleado','p.nombre1','p.apellido1','aj.idasignajefe','h.fecha','h.historia as hsa','h.comentario')
        ->where('e.idempleado','=',$id)
        ->get();

        /*$asignajefe=DB::table('asignajefe as aj')
            ->join('persona as p','aj.identificacion','=','p.identificacion')
            ->join('historia as h','h.idasignajefe','=','aj.idasignajefe')
            
            ->select('p.nombre1','p.apellido1','aj.idasignajefe')               
            ->groupBy('p.nombre1','p.apellido1','aj.idasignajefe')
            ->where('h.idasignajefe','=','aj.idasignajefe')
            ->get();*/

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
        //dd($asignajefe);
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
        ->select('p.nombre1','p.apellido1','a.nombre as naf','pu.nombre as npu','c.nombre as nc','nt.fecha','nt.salario')
        ->where('e.idempleado','=',$id)
        ->get();

        return view('listados.empleado.laboral',["historia"=>$historia]);
    }
}
