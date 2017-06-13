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

class RHPermiso extends Controller
{
     public function indexsolicitado (Request $request)
    {
    	if ($request)
    	{
        //$query=trim($request->get('searchText'));

	        $permisos = DB::table('asignajefe as aj')
	        ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
	        ->join('ausencia as au','emp.idempleado','=','au.idempleado')
	        ->join('persona as per','emp.identificacion','=','per.identificacion')
	        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
	        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia','au.totaldias','au.totalhoras','au.justificacion')
	        ->where('au.autorizacion','=','solicitado')
	        ->where('tp.idtipoausencia','!=','3')
	        ->orderBy('au.fechasolicitud','desc') 
	        ->paginate(15);       
    	}

    	//return view('director.permisos.index',["permisos"=>$permisos,"searchText"=>$query]);
    	return view('listados.permisos.index',["permisos"=>$permisos]);
    }

    public function indexconfirmado (Request $request)
    {
       $permisos = DB::table('asignajefe as aj')
	        ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
	        ->join('ausencia as au','emp.idempleado','=','au.idempleado')
	        ->join('persona as per','emp.identificacion','=','per.identificacion')
	        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
	        ->join('users as U','au.id','=','U.id')
	         ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia','au.totaldias','au.totalhoras','U.name','au.justificacion')
	        ->where('au.autorizacion','=','Confirmado')
	        ->where('tp.idtipoausencia','!=','3')
	        ->orderBy('au.fechasolicitud','desc')
	        ->paginate(15);

        return view('listados.permisos.indexconfirmado',["permisos"=>$permisos])  ;        
    }

     public function indexrechazado (Request $request)
    {
        $permisos = DB::table('asignajefe as aj')
	        ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
	        ->join('ausencia as au','emp.idempleado','=','au.idempleado')
	        ->join('persona as per','emp.identificacion','=','per.identificacion')
	        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
	        ->join('users as U','au.id','=','U.id')
	        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia','au.totaldias','au.totalhoras','U.name','au.justificacion','au.observaciones')
	        ->where('au.autorizacion','=','Rechazado')
	        ->where('tp.idtipoausencia','!=','3')
	        ->orderBy('au.fechasolicitud','desc')
	        ->paginate(15);

        return view('listados.permisos.indexrechazado',["permisos"=>$permisos])  ;        
    }
}
