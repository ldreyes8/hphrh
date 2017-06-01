<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Vacaciones;

use Mail;

class PermisosController extends Controller
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
        ->where('au.autorizacion','=','solicitado')
        ->where('tp.idtipoausencia','!=','3')        
   
        ->paginate(15);       
    	}
     

    	return view('director.permisos.index',["permisos"=>$permisos,"searchText"=>$query]);
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
        ->where('tp.idtipoausencia','!=','3')        
   
        ->paginate(15);   

        return view('director.permisos.indexconfirmado',["permisos"=>$permisos])  ;        
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
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia')
        ->where('aj.identificacion','=',$usuario->identificacion)
        ->where('au.autorizacion','=','Rechazado')
        ->where('tp.idtipoausencia','!=','3')        
   
        ->paginate(15); 

        return view('director.permisos.indexrechazado',["permisos"=>$permisos])  ;        
    }

    public function verificar($id)
    {
      $empleado =DB::table('ausencia as au')
      ->join('empleado as emp','au.idempleado','=','emp.idempleado')
      ->join('persona as per','emp.identificacion','=','per.identificacion')
      //->join('jefesinmediato as jf','emp.idjefeinmediato','=','jf.idjefeinmediato')
      ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
      ->join('users as U','per.identificacion','=','U.identificacion')
      ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.horainicio','au.horafin','au.totaldias','au.totalhoras','au.concurrencia','emp.idempleado','U.email','au.idausencia','au.justificacion')
      ->where('au.idausencia','=',$id)
      ->first();

      $user = DB::table('users as U')
      ->join('persona as per','U.identificacion','=','per.identificacion')
      ->select('per.nombre1','per.nombre2','apellido1','apellido2')
      ->where('U.id','=',Auth::user()->id)
      ->first();

      return view('director.permisos.detalle',["empleado"=>$empleado,"user"=>$user]);            
    }

    public function enviarpermiso(Request $request)
    {
      $this->validateRequest($request);  

      $codigo=$request->idausencia;
     
      $ausencia = Vacaciones::find($codigo);

      $ausencia->observaciones = $request->observaciones;
      $ausencia->autorizacion = $request->autorizacion;
      $ausencia->save();

      
      Mail::send('emails.envempermiso',$request->all(), function($msj) use ($request){
        $receptor = $request->receptor;
        $msj->subject('Respuesta de solicitud de permiso');
        $msj->to($receptor);
                //$msj->to('drdanielreyes5@gmail.com');
      });

      return response()->json($ausencia);
    }

    public function validateRequest($request){
        $rules=[
        'observaciones' => 'required|max:100',
        'autorizacion' => 'required',

        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }
    
    public function detalleconfirmado($id)
    {
      $empleado =DB::table('ausencia as au')
        ->join('empleado as emp','au.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        //->join('jefesinmediato as jf','emp.idjefeinmediato','=','jf.idjefeinmediato')
        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.horainicio','au.horafin','au.totaldias','au.totalhoras','au.concurrencia','emp.idempleado','U.email','au.idausencia')
        ->where('au.idausencia','=',$id)
        ->first();
      //dd($empleado);
      return view('director.permisos.confirmado',["empleado"=>$empleado]);            
    }

    public function detallerechazado($id)
    {
      $empleado =DB::table('ausencia as au')
        ->join('empleado as emp','au.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        //->join('jefesinmediato as jf','emp.idjefeinmediato','=','jf.idjefeinmediato')
        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.horainicio','au.horafin','au.totaldias','au.totalhoras','au.concurrencia','emp.idempleado','U.email','au.idausencia')
        ->where('au.idausencia','=',$id)
        ->first();
      return view('director.permisos.rechazado',["empleado"=>$empleado]);            
    }
}


