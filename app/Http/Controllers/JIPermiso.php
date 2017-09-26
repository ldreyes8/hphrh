<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Vacaciones;
use App\Tausencia;
use App\Notificacion;

use Mail;

class JIPermiso extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function indexdirector(Request $request)
    {        
        //dd($request->get('idform'));
        return view('director.index');
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
        ->orderBy('au.fechasolicitud','desc')

        ->paginate(15);

        $tipoausencias = Tausencia::all();
   
        //->paginate(1);
      }
      return view('director.autorizaciones.solicitados',["permisos"=>$permisos,"searchText"=>$query,"tipoausencias"=>$tipoausencias]);
      //return view('director.permisos.index',["permisos"=>$permisos,"searchText"=>$query]);
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
        ->orderBy('au.fechasolicitud','desc')
        ->paginate(15);

        $tipoausencias = Tausencia::all();

        return view('director.autorizaciones.autorizados',["permisos"=>$permisos,"tipoausencias"=>$tipoausencias]);        
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
        ->orderBy('au.fechasolicitud','desc')

        ->paginate(15);

        $tipoausencias = Tausencia::all();


        return view('director.autorizaciones.rechazados',["permisos"=>$permisos,"tipoausencias"=>$tipoausencias]);        
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
      try 
      {
        $this->validateRequest($request);  

        $codigo=$request->idausencia;
        $idempleado=$request->idempleado;

       
        $ausencia = Vacaciones::find($codigo);

        $ausencia->observaciones = $request->observaciones;
        $ausencia->autorizacion = $request->autorizacion;
        $ausencia->id=Auth::user()->id;
        $ausencia->save();

        $idnoti = DB::table('notificacion as n')
        ->select('n.idnotificacion')
        ->where('n.idausencia','=',$codigo)
        ->first();


        $notificacion = new Notificacion;

        $notificacion->idemisor = Auth::user()->id;
        $notificacion->idreceptor = $idempleado;
        $notificacion->tiponotificacion = "Permisos";
        $notificacion->estado = 1;
        $notificacion->autorizacion = $request->autorizacion;
        $notificacion->respuesta = 1;

        $notificacion->save();

        if(empty($idnoti)){

        }
        else{
            $notidelete = DB::table('notificacion')->where('idnotificacion','=',$idnoti->idnotificacion)->delete();
        }

       

        /*
        Mail::send('emails.envempermiso',$request->all(), function($msj) use ($request){
          $receptor = $request->receptor;
          $msj->subject('Respuesta de solicitud de permiso');
          $msj->to($receptor);
                  //$msj->to('drdanielreyes5@gmail.com');
        });*/

        DB::commit();
      }catch (\Exception $e) 
      {
        DB::rollback();
        return response()->json(array('error' => 'No se ha podido enviar la respuesta'),404);         
      }

      return response()->json($ausencia);
    }


    public function busquedasolicitados($tipoausencia, $dato="")
    {
      $usuario = DB::table('users as U')
        ->join('persona as per','U.identificacion','=','per.identificacion')
        ->join('asignajefe as jf','per.identificacion','=','jf.identificacion')
        ->select('jf.identificacion')
        ->where('U.id','=',Auth::user()->id)
        ->first();

        $permisos= Vacaciones::Busqueda($tipoausencia,$dato)->join('empleado as emp','ausencia.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('tipoausencia as tp','ausencia.idtipoausencia','=','tp.idtipoausencia')
        ->join('asignajefe as aj','emp.idempleado','=','aj.idempleado')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','ausencia.fechasolicitud','tp.ausencia','ausencia.fechainicio','ausencia.fechafin','ausencia.idausencia','ausencia.totaldias','ausencia.totalhoras','ausencia.justificacion')
        ->where('aj.identificacion','=',$usuario->identificacion)
        ->where('ausencia.autorizacion','=','solicitado')
        ->orderBy('ausencia.fechasolicitud','desc') 
        ->paginate(15);

        $tipoausencias = Tausencia::all();
        $tiposel=$tipoausencias->find($tipoausencia);

        return view('director.autorizaciones.solicitados')
        ->with("permisos", $permisos )
        ->with("tipoausencias", $tipoausencias)
        ->with("tiposel", $tiposel);

    }

    public function busquedaconfirmados($tipoausencia, $dato="")
    {
      $usuario = DB::table('users as U')
        ->join('persona as per','U.identificacion','=','per.identificacion')
        ->join('asignajefe as jf','per.identificacion','=','jf.identificacion')
        ->select('jf.identificacion')
        ->where('U.id','=',Auth::user()->id)
        ->first();

        $permisos= Vacaciones::Busqueda($tipoausencia,$dato)->join('empleado as emp','ausencia.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('tipoausencia as tp','ausencia.idtipoausencia','=','tp.idtipoausencia')
        ->join('asignajefe as aj','emp.idempleado','=','aj.idempleado')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','ausencia.fechasolicitud','tp.ausencia','ausencia.fechainicio','ausencia.fechafin','ausencia.idausencia','ausencia.totaldias','ausencia.totalhoras','ausencia.justificacion')
        ->where('aj.identificacion','=',$usuario->identificacion)
        ->where('ausencia.autorizacion','=','Confirmado')
        ->orderBy('ausencia.fechasolicitud','desc') 
        ->paginate(15);

        $tipoausencias = Tausencia::all();
        $tiposel=$tipoausencias->find($tipoausencia);

        return view('director.autorizaciones.autorizados')
        ->with("permisos", $permisos )
        ->with("tipoausencias", $tipoausencias)
        ->with("tiposel", $tiposel);

    }

    public function busquedarechazados($tipoausencia, $dato="")
    {
      $usuario = DB::table('users as U')
        ->join('persona as per','U.identificacion','=','per.identificacion')
        ->join('asignajefe as jf','per.identificacion','=','jf.identificacion')
        ->select('jf.identificacion')
        ->where('U.id','=',Auth::user()->id)
        ->first();

        $permisos= Vacaciones::Busqueda($tipoausencia,$dato)->join('empleado as emp','ausencia.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('tipoausencia as tp','ausencia.idtipoausencia','=','tp.idtipoausencia')
        ->join('asignajefe as aj','emp.idempleado','=','aj.idempleado')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.identificacion','ausencia.fechasolicitud','tp.ausencia','ausencia.fechainicio','ausencia.fechafin','ausencia.idausencia','ausencia.totaldias','ausencia.totalhoras','ausencia.justificacion')
        ->where('aj.identificacion','=',$usuario->identificacion)
        ->where('ausencia.autorizacion','=','Rechazado')
        ->orderBy('ausencia.fechasolicitud','desc') 
        ->paginate(15);

        $tipoausencias = Tausencia::all();
        $tiposel=$tipoausencias->find($tipoausencia);

        return view('director.autorizaciones.rechazados')
        ->with("permisos", $permisos )
        ->with("tipoausencias", $tipoausencias)
        ->with("tiposel", $tiposel);

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
