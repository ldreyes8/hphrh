<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Empleado;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;  // para poder usar la fecha y hora
use App\Constants;

class JIReporte extends Controller
{
	public function JI(){
    	$usuario = DB::table('users as U')
          	->join('persona as per','U.identificacion','=','per.identificacion')
         	->join('asignajefe as jf','per.identificacion','=','jf.identificacion')
          	->select('jf.identificacion')
          	->where('U.id','=',Auth::user()->id)
          	->first();
        return $usuario;
    }

    public function reportevp(Request $request)
    {
    	/*
    	$empleado = Empleado::join('nomytras as nt','empleado.idempleado','=','nt.idempleado')
        ->join('status as st','empleado.idstatus','=','st.idstatus')
        ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
        ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
        ->join('caso as c','c.idcaso','=','nt.idcaso')
        ->join('asignajefe as aj','empleado.idempleado','=','aj.idempleado')
        ->select('empleado.idempleado','empleado.identificacion','empleado.nit','st.statusemp as statusn','pu.nombre as puesto','af.nombre as afiliado','c.idcaso',DB::raw('max(nt.idnomytas) as idnomytas'))
        ->where('aj.identificacion','=',$this->JI()->identificacion)
        ->where('c.idcaso','=',4)
        ->orwhere('c.idcaso','=',6)
        ->where('aj.identificacion','=',$this->JI()->identificacion)
        ->orwhere('c.idcaso','=',7)
        ->where('aj.identificacion','=',$this->JI()->identificacion)
        ->groupBy('empleado.idempleado')
        ->get();*/


        $empleado = DB::select("call JI_vempleado(?)",array($this->JI()->identificacion));


        return view("director.reporte.vpempleado",["empleado"=>$empleado]);
    }


    public function vpindex(Request $request)
    {
        $empleado = Empleado::join('nomytras as nt','empleado.idempleado','=','nt.idempleado')
        ->join('status as st','empleado.idstatus','=','st.idstatus')
        ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
        ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
        ->join('caso as c','c.idcaso','=','nt.idcaso')
      ->join('asignajefe as aj','empleado.idempleado','=','aj.idempleado')
        ->select('empleado.idempleado','empleado.identificacion','empleado.nit','st.statusemp as statusn','pu.nombre as puesto','af.nombre as afiliado','c.idcaso',DB::raw('max(nt.idnomytas) as idnomytas'))
        ->where('aj.identificacion','=',$this->JI()->identificacion)
        ->groupBy('empleado.idempleado')
        ->get();

        return view("director.reporte.vpindex",["empleado"=>$empleado]);
    }

    public function vempleado(Request $request,$id)
    {
      $today = Carbon::now();
    
      $year = $today->format('Y');
      $year1 = $today->format('Y');

      $inicioaño = $year1.'-01-01';      // se concatena el año actual con un texto determinado para obtener el incio del año actual
      $finaño = $year1.'-12-31';         // se concatena el año actual con un texto determinado para obtener el fin del año actual

      $historialvacaciones =DB::table('ausencia as a')
          ->join('empleado as emp','a.idempleado','=','emp.idempleado')
          ->join('persona as per','emp.identificacion','=','per.identificacion') 
          ->join('tipoausencia as ta','a.idtipoausencia','=','ta.idtipoausencia')
          ->join('vacadetalle as vd','a.idausencia','=','vd.idausencia')
          ->select('a.fechainicio','a.fechafin','a.autorizacion','a.fechasolicitud','a.totaldias','a.totalhoras',DB::raw('sum(a.totaldias - vd.soldias) as diastomados'),DB::raw('sum(a.totalhoras - vd.solhoras) as htomado'))
          ->where('ta.ausencia','=','Vacaciones')
          ->where('emp.idempleado','=',$id)
          ->where('a.fechasolicitud', '>=', $inicioaño)
          ->where('a.fechasolicitud', '<=', $finaño)
          ->groupBy('a.fechainicio','a.fechafin','a.autorizacion','a.fechasolicitud','a.totaldias','a.totalhoras')
          ->orderBy('a.fechasolicitud','desc')
          ->get();

        return view("director.reporte.empleadov",["historialvacaciones"=>$historialvacaciones,"year"=>$year]);
    }

    public function pempleado(Request $request,$id)
    {
        $today = Carbon::now();
    
        $year = $today->format('Y');
        $year1 = $today->format('Y');

        $inicioaño = $year1.'-01-01';      // se concatena el año actual con un texto determinado para obtener el incio del año actual
        $finaño = $year1.'-12-31';         // se concatena el año actual con un texto determinado para obtener el fin del año actual

        $ausencias=DB::table('ausencia as a')
        ->join('empleado as emp','a.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('tipoausencia as ta','a.idtipoausencia','=','ta.idtipoausencia')
        ->select('a.fechainicio','a.fechafin','a.horainicio','a.horafin','a.juzgadoinstitucion','a.tipocaso','a.autorizacion','a.fechasolicitud','ta.ausencia as tipoausencia')
        ->where('emp.idempleado','=',$id)
        ->where('ta.ausencia','!=','Vacaciones')
        ->where('a.fechasolicitud', '>=', $inicioaño)
        ->where('a.fechasolicitud', '<=', $finaño)
        ->orderBy('a.fechasolicitud','desc')
        ->get();

        return view('director.reporte.empleadop',["ausencias"=>$ausencias,"year"=>$year]);
    }
}
/*
$empleado=Empleado::join('nomytras as nt','empleado.idempleado','=','nt.idempleado')
        ->join('status as st','empleado.idstatus','=','st.idstatus')
        ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
        ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
        ->join('caso as c','c.idcaso','=','nt.idcaso')
        ->select('empleado.idempleado','empleado.identificacion','empleado.nit','st.statusemp as statusn','pu.nombre as puesto','af.nombre as afiliado','c.idcaso',DB::raw('max(nt.idnomytas) as idnomytas'))
        ->where('empleado.idstatus','=', 2)
        ->groupBy('empleado.idempleado')      
        ->orderBy('af.nombre','asc')
        ->orderBy('pu.nombre','asc')
        ->get();*/