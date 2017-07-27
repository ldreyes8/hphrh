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

use App\Tausencia;
use App\Vacaciones;

class RHPermiso extends Controller
{

	public function listadoPV(Request $request)
    {
        return view('rrhh.permisosvacaciones.index');
    }

     public function indexsolicitado (Request $request)
    {/*
       
 $permisos = DB::table('asignajefe as aj')
            ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
            ->join('ausencia as au','emp.idempleado','=','au.idempleado')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
            ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia','au.totaldias','au.totalhoras','au.justificacion')
            ->where('au.autorizacion','=','solicitado')
            //->where('tp.idtipoausencia','!=','3')
            ->orderBy('au.fechasolicitud','desc') 
            ->paginate(15);
            */


        $permisos=vacaciones::join('empleado as emp','ausencia.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('tipoausencia as tp','ausencia.idtipoausencia','=','tp.idtipoausencia')
            ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','ausencia.fechasolicitud','tp.ausencia','ausencia.fechainicio','ausencia.fechafin','ausencia.idausencia','ausencia.totaldias','ausencia.totalhoras','ausencia.justificacion')
            ->where('ausencia.autorizacion','=','solicitado')
            //->where('tp.idtipoausencia','!=','3')
            ->orderBy('ausencia.fechasolicitud','desc') 
        ->paginate(15);
        $tipoausencias = Tausencia::all();


        return view('rrhh.permisosvacaciones.indexsolicitados',["permisos"=>$permisos,"tipoausencias"=>$tipoausencias]);
    }

    public function indexconfirmado (Request $request)
    {
        $permisos = DB::table('asignajefe as aj')
	        ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
	        ->join('ausencia as au','emp.idempleado','=','au.idempleado')
	        ->join('persona as per','emp.identificacion','=','per.identificacion')
	        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
	        ->join('users as U','au.id','=','U.id')
            ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia','au.totaldias','au.totalhoras','U.name','au.justificacion','au.observaciones')
	        ->where('au.autorizacion','=','Confirmado')
	        //->where('tp.idtipoausencia','!=','3')
	        ->orderBy('au.fechasolicitud','desc')
	        ->paginate(15);

        $tipoausencias = Tausencia::all();

        return view('rrhh.permisosvacaciones.indexconfirmado',["permisos"=>$permisos,"tipoausencias"=>$tipoausencias]);        
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
	        //->where('tp.idtipoausencia','!=','3')
	        ->orderBy('au.fechasolicitud','desc')
	        ->paginate(15);

        $tipoausencias = Tausencia::all();

        return view('rrhh.permisosvacaciones.indexrechazado',["permisos"=>$permisos,"tipoausencias"=>$tipoausencias]);        
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

    public function busquedasolicitados($tipoausencia, $dato="")
    {

        $permisos= Vacaciones::Busqueda($tipoausencia,$dato)->join('empleado as emp','ausencia.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('tipoausencia as tp','ausencia.idtipoausencia','=','tp.idtipoausencia')
            ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','ausencia.fechasolicitud','tp.ausencia','ausencia.fechainicio','ausencia.fechafin','ausencia.idausencia','ausencia.totaldias','ausencia.totalhoras','ausencia.justificacion')
            ->where('ausencia.autorizacion','=','solicitado')
            //->where('tp.idtipoausencia','!=','3')
            ->orderBy('ausencia.fechasolicitud','desc') 
        ->paginate(15);

        $tipoausencias = Tausencia::all();
        $tiposel=$tipoausencias->find($tipoausencia);

        return view('rrhh.permisosvacaciones.indexsolicitados')
        ->with("permisos", $permisos )
        ->with("tipoausencias", $tipoausencias)
        ->with("tiposel", $tiposel);

    }

    public function busquedaconfirmados($tipoausencia, $dato="")
    {
        $permisos= Vacaciones::Busqueda($tipoausencia,$dato)->join('empleado as emp','ausencia.idempleado','=','emp.idempleado')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->join('tipoausencia as tp','ausencia.idtipoausencia','=','tp.idtipoausencia')
            ->join('users as U','ausencia.id','=','U.id')
            ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','ausencia.fechasolicitud','tp.ausencia','ausencia.fechainicio','ausencia.fechafin','ausencia.idausencia','ausencia.totaldias','ausencia.totalhoras','ausencia.justificacion','U.name','ausencia.observaciones')
            ->where('ausencia.autorizacion','=','Confirmado')
            ->orderBy('ausencia.fechasolicitud','desc') 
            ->paginate(15);

        $tipoausencias = Tausencia::all();
        $tiposel=$tipoausencias->find($tipoausencia);

        return view('rrhh.permisosvacaciones.indexconfirmado')
        ->with("permisos", $permisos )
        ->with("tipoausencias", $tipoausencias)
        ->with("tiposel", $tiposel);
    }

    public function busquedarechazados($tipoausencia, $dato="")
    {
        $permisos= Vacaciones::Busqueda($tipoausencia,$dato)->join('empleado as emp','ausencia.idempleado','=','emp.idempleado')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->join('tipoausencia as tp','ausencia.idtipoausencia','=','tp.idtipoausencia')
            ->join('users as U','ausencia.id','=','U.id')
            ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','ausencia.fechasolicitud','tp.ausencia','ausencia.fechainicio','ausencia.fechafin','ausencia.idausencia','ausencia.totaldias','ausencia.totalhoras','ausencia.justificacion','U.name','ausencia.observaciones')
            ->where('ausencia.autorizacion','=','Rechazado')
            ->orderBy('ausencia.fechasolicitud','desc') 
            ->paginate(15);

        $tipoausencias = Tausencia::all();
        $tiposel=$tipoausencias->find($tipoausencia);

        return view('rrhh.permisosvacaciones.indexrechazado')
        ->with("permisos", $permisos )
        ->with("tipoausencias", $tipoausencias)
        ->with("tiposel", $tiposel);
    }
}
