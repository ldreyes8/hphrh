<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UserFormRequest;
use App\Vacaciones;
use App\Vacadetalle;
use App\Tausencia;
//use App\HPMEConstants;
use App\Http\Requests\VRequest;
use App\Notificacion;
use Validator;

use Carbon\Carbon;  // para poder usar la fecha y hora
use Illuminate\Support\Facades\Auth; 

use Illuminate\Support\Collection as Collection;

use DB;
use PDF;

use Mail;

class NotificacionController extends Controller
{
	public function notificacion(Request $request)
  	{
  		$usuario = DB::table('users as U')
    	->join('persona as per','U.identificacion','=','per.identificacion')
	    ->join('asignajefe as jf','per.identificacion','=','jf.identificacion')
	    ->select('jf.identificacion')
	    ->where('U.id','=',Auth::user()->id)
	    ->first();

	    $respuesta = DB::table('notificacion')
	    ->select('tiponotificacion','autorizacion','idnotificacion')
	    ->where('idreceptor','=',Auth::user()->id)
	    ->where('respuesta','=',1)
	    ->get();

	    if($usuario === null)
	    {
	    	return view('notificacion.notificacion',["respuesta"=>$respuesta]);	        
	    }
	    else
	    {
	    	$notivaca = DB::table('asignajefe as aj')
	        ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
	        ->join('ausencia as au','emp.idempleado','=','au.idempleado')
	        ->join('persona as per','emp.identificacion','=','per.identificacion')

	        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
	        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia')
	        ->where('aj.identificacion','=',$usuario->identificacion)
	        ->where('au.autorizacion','=','solicitado')
	        ->where('tp.idtipoausencia','=','3')           
	        ->paginate(15);

	        $notiper = DB::table('asignajefe as aj')
	        ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
	        ->join('ausencia as au','emp.idempleado','=','au.idempleado')
	        ->join('persona as per','emp.identificacion','=','per.identificacion')

	        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
	        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia')
	        ->where('aj.identificacion','=',$usuario->identificacion)
	        ->where('au.autorizacion','=','solicitado')
	        ->where('tp.idtipoausencia','!=','3')           
	        ->paginate(15);

	        $confirgoce = DB::table('notificacion as not')
	        ->join('ausencia as a','not.idausencia','=','a.idausencia')
	        ->join('empleado as emp','a.idempleado','=','emp.idempleado')
	        ->join('persona as per','emp.identificacion','=','per.identificacion')
	        ->join('vacadetalle as vd','a.idausencia','=','vd.idausencia')
		    ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'not.idemisor','not.idausencia')
		    ->where('idreceptor','=',Auth::user()->id)
		    ->where('vd.goce','!=','NULL')
		    ->where('not.estado','=',1)
		    ->get();
	        
	    	return view('notificacion.notificacion',["notivaca"=>$notivaca,"notiper"=>$notiper,"respuesta"=>$respuesta,"confirgoce"=>$confirgoce]);
	    }
	}

	public function leernotifica(Request $request)
	{
		$idnotificacion = $request->idnotificacion;
		$notidelete = DB::table('notificacion')->where('idnotificacion','=',$idnotificacion)->delete();
        return response()->json($notidelete);
	}

	public function indexconfirmado (Request $request)
	{
		$usuario = DB::table('users as U')
	    ->join('persona as per','U.identificacion','=','per.identificacion')
	    ->join('asignajefe as jf','per.identificacion','=','jf.identificacion')
	    ->select('jf.identificacion')
	    ->where('U.id','=',Auth::user()->id)
	    ->first();

	    $permisos = DB::table('asignajefe as aj')
	    ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
	    ->join('ausencia as au','emp.idempleado','=','au.idempleado')
	    ->join('persona as per','emp.identificacion','=','per.identificacion')

	    ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
	    ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia')
	    ->where('aj.identificacion','=',$usuario->identificacion)
	    ->where('au.autorizacion','=','Confirmado')
	    ->where('tp.idtipoausencia','=','3')        
	    ->paginate(15);  

	    return view('director.vacaciones.indexconfirmado',["permisos"=>$permisos]);        
	}

  	public function indexrechazado (Request $request)
  	{
	    $usuario = DB::table('users as U')
	    ->join('persona as per','U.identificacion','=','per.identificacion')
	    ->join('asignajefe as jf','per.identificacion','=','jf.identificacion')
	    ->select('jf.identificacion')
	    ->where('U.id','=',Auth::user()->id)
	    ->first();

	    $permisos = DB::table('asignajefe as aj')
	    ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
	    ->join('ausencia as au','emp.idempleado','=','au.idempleado')
	    ->join('persona as per','emp.identificacion','=','per.identificacion')

	    ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
	    ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia')
	    ->where('aj.identificacion','=',$usuario->identificacion)
	    ->where('au.autorizacion','=','Rechazado')
	    ->where('tp.idtipoausencia','=','3')        
	   
	    ->paginate(15);  

	    return view('director.vacaciones.indexrechazado',["permisos"=>$permisos]);        
  	}

  	public function indexautorizado (Request $request)
  	{
	    $usuario = DB::table('users as U')
	    ->join('persona as per','U.identificacion','=','per.identificacion')
	    ->join('asignajefe as jf','per.identificacion','=','jf.identificacion')
	    ->select('jf.identificacion')
	    ->where('U.id','=',Auth::user()->id)
	    ->first();

	    $permisos = DB::table('asignajefe as aj')
	    ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
	    ->join('ausencia as au','emp.idempleado','=','au.idempleado')
	    ->join('persona as per','emp.identificacion','=','per.identificacion')

	    ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
	    ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia')
	    ->where('aj.identificacion','=',$usuario->identificacion)
	    ->where('au.autorizacion','=','Autorizado')
	    ->where('tp.idtipoausencia','=','3')        

	    
	    ->paginate(15);  


	    return view('director.autorizaciones.constancias',["permisos"=>$permisos]);        
  	}
}
