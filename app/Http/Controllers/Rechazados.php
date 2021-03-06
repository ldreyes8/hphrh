<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Storage;
use DB;
use Carbon\Carbon; 
use Response;
use App\Persona;
use App\Empleado;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Rechazados extends Controller
{
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
        ->join('status as st','e.idstatus','=','st.idstatus')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('afiliado as af','p.idafiliado','=','af.idafiliado')
        ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
        ->select('e.idempleado','e.identificacion','e.nit','p.nombre1','p.nombre2','p.apellido1','p.apellido2','af.nombre as fnombre','pu.nombre as pnombre','st.statusemp as statusn')
        ->where('e.idstatus','=',10)
        ->where('p.nombre1','LIKE','%'.$query.'%')
        ->orderBy('e.idempleado','desc')
        //->orderBy('e.idempleado','desc')
         ->paginate(10);
        }

        $puestos=DB::table('puesto as p')
        ->where('p.statusp','=','2')
        ->orderBy('p.nombre','asc')
        ->get();
        $afiliados=DB::table('afiliado as a')
        ->where('a.statusa','=','2')
        ->orderBy('a.nombre','asc')
        ->get();
        return view("rrhh.empleados.rechazados",["empleado"=>$empleado,'afiliados'=>$afiliados,"puestos"=>$puestos,"searchText"=>$query]);
    }
    public function nombrelistr($id)
    {
        //dd($id);
        $empleado=DB::table('persona as p')
        ->join('empleado as e','e.identificacion','=','p.identificacion')
        ->select('p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','e.idempleado')
        ->where('p.identificacion','=',$id)
        ->first();
        return response()->json($empleado);
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
            ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
            ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
            ->select('p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.celular as telefono','p.fechanac','p.barriocolonia','a.nombre as afiliado','pu.nombre as puesto','p.finiquitoive')
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
            ->select('p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.telefono','p.fechanac','p.avenida','p.calle','p.nomenclatura','p.zona','p.barriocolonia','dp.nombre as departamento','m.nombre as municipio','a.nombre as afiliado','pu.nombre as puesto')
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
    //
      
        return view('listados.rechazados.show',["persona"=>$persona,"empleado"=>$empleado,"academicos"=>$academicos,"experiencias"=>$experiencias,"familiares"=>$familiares,"idiomas"=>$idiomas,"referencias"=>$referencias,"deudas"=>$deudas,"padecimientos"=>$padecimientos]);
        //return view('listados.empleado.show',["empleado"=>$empleado]);
    }

    public function eliminar($id)
    {

        $cre = Persona::findOrFail($id); 
            Persona::destroy($id); 
        return Redirect::to('rh/listado');
        //return view('rrhh.empleados.rechazados');
    }
    public function uprechazo(Request $request, $id)
    {
        
        $idemp = $request->get('empleado');
        $upp= Persona::findOrFail($id);
        $upp-> idpuesto = $request->get('puesto');
        $upp-> idafiliado = $request->get('afiliado');
        $upp->save();

        $emp= Empleado::findOrFail($idemp);
        $emp-> idstatus = '1';
        $mytime = Carbon::now('America/Guatemala');
        $emp-> fechasolicitud=$mytime->toDateTimeString();
        $emp->save();

        return response()->json($upp);
    }
}
