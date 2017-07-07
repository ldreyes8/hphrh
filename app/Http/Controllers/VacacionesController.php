<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Vacaciones;
use App\Vacadetalle;

use Mail;

class VacacionesController extends Controller
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

      $vacaciones = DB::table('asignajefe as aj')
      ->join('empleado as emp','aj.idempleado','=','emp.idempleado')
      ->join('ausencia as au','emp.idempleado','=','au.idempleado')
      ->join('persona as per','emp.identificacion','=','per.identificacion')

      ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
      ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia')
      ->where('aj.identificacion','=',$usuario->identificacion)
      ->where('au.autorizacion','=','solicitado')
      ->where('tp.idtipoausencia','=','3')           
      ->paginate(15);                 
    	}

    return view('director.vacaciones.index',["vacaciones"=>$vacaciones,"searchText"=>$query]);
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

    return view('director.vacaciones.indexconfirmado',["permisos"=>$permisos])  ;        
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

    ->get();

    return view('director.autorizaciones.constancias',["permisos"=>$permisos]);        
  }

  public function verificar($id)
  {
    $empleado =DB::table('ausencia as au')
    ->join('empleado as emp','au.idempleado','=','emp.idempleado')
    ->join('persona as per','emp.identificacion','=','per.identificacion')
      
    ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
    ->join('users as U','per.identificacion','=','U.identificacion')
    ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.horainicio','au.horafin','au.totaldias','au.totalhoras','emp.idempleado','U.email','au.idausencia')
    ->where('au.idausencia','=',$id)
    ->first();
     
    $dias =DB::table('vacadetalle as va')
    ->join('empleado as emp','va.idempleado','=','emp.idempleado')
    ->join('persona as per','emp.identificacion','=','per.identificacion')
    ->select('va.idempleado','va.idausencia','va.acuhoras','va.acudias','va.fecharegistro','va.idvacadetalle','va.soldias','va.solhoras')
    ->where('emp.idempleado','=',$empleado->idempleado)
    ->where('va.estado','=','1')
    ->orderBy('va.idvacadetalle','desc')
    ->first();

    $user = DB::table('users as U')
    ->join('persona as per','U.identificacion','=','per.identificacion')
    ->select('per.nombre1','per.nombre2','apellido1','apellido2')
    ->where('U.id','=',Auth::user()->id)
    ->first();

    $fecharegistro = $dias->fecharegistro;    
    $diasactual = $dias->acudias;   //obtiene la ultima fecha en donde se registro un nuevo registro
    $horasactual = $dias->acuhoras;
    $diasol = $dias->soldias;
    $horasol = $dias->solhoras;

    $dt = Carbon::parse($fecharegistro);  // convertimos la fecha en el formato Y-mm-dddd h:i:s
    $today = Carbon::now();
    
    $year = $today->format('Y');

    if((($year%4 == 0) && ($year%100)) || $year%400 == 0)
    {$year = 366;}
    else{$year = 365;}

    $ftoday = $today->toDateString();
   
    if($fecharegistro > $ftoday)
    {
      $thoras = $horasactual + $horasol;
      $dias = $diasactual + $diasol; 
    }
    elseif ($fecharegistro == $ftoday) {
      $thoras =  $horasactual + $horasol;
      $dias = $diasactual + $diasol;
    }
    else
    {
      $add = $today->dayOfYear;  //obtiene los dias transcurridos hasta la fecha actual
      $dias = (strtotime($today)-strtotime($fecharegistro))/86400;
      $dias   = abs($dias); $dias = floor($dias); 
      $dias = $dias * 20;

      $dias = $dias / $year;
      $dias = round($dias, 2);

      $tdia = explode(".",$dias);
      $dias = $tdia[0];

      if (empty($tdia[1])) {
      	
        $thoras =0;
        $thoras = $horasactual + $thoras + $horasol;
        $dias = $diasactual + $dias + $diasol; 
      }
      else{
        $thoras = $tdia[1];

        $thoras = '0.'.$thoras;
        $thoras = $thoras * 8;

        $thora = explode(".",$thoras);
        $thoras = $thora[0];

        $thoras = $horasactual + $thoras;
        $dias = $diasactual + $dias;
      }

		  if($thoras >= 8)
		  {
		    $thoras = $thoras -8;
		    $dias = $dias +1;
		  }      
		}
    $calculo = array($thoras,$dias);
    return view('director.vacaciones.detalle',["empleado"=>$empleado,"calculo"=>$calculo,"user"=>$user]);            
  }

  public function confirmar($id)
  {
    $empleado =DB::table('ausencia as au')
    ->join('empleado as emp','au.idempleado','=','emp.idempleado')
    ->join('persona as per','emp.identificacion','=','per.identificacion')
      
    ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
    ->join('users as U','per.identificacion','=','U.identificacion')
    ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ",per.apellido2) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.horainicio','au.horafin','au.totaldias','au.totalhoras','emp.idempleado','U.email','au.idausencia')
    ->where('au.idausencia','=',$id)
    ->first();
        //dd($empleado);

    $dias =DB::table('vacadetalle as va')
    ->join('empleado as emp','va.idempleado','=','emp.idempleado')
    ->join('persona as per','emp.identificacion','=','per.identificacion')
    ->join('ausencia as a','emp.idempleado','=','a.idempleado')        
    ->select('va.idempleado','va.idausencia','va.acuhoras','va.acudias','va.fecharegistro','va.idvacadetalle','va.solhoras','va.soldias','va.goce','va.observaciones')
    ->where('a.idausencia','=',$id)
    ->orderBy('va.idvacadetalle','desc')
    ->first();

    $user = DB::table('users as U')
    ->join('persona as per','U.identificacion','=','per.identificacion')
    ->select('per.nombre1','per.nombre2','apellido1','apellido2')
    ->where('U.id','=',Auth::user()->id)
    ->first();

    return view('director.vacaciones.confirmado',["empleado"=>$empleado,"dias"=>$dias,"user"=>$user]);            
  }

  public function dconfirmar($id)
  {
    $empleado =DB::table('ausencia as au')
    ->join('empleado as emp','au.idempleado','=','emp.idempleado')
    ->join('persona as per','emp.identificacion','=','per.identificacion')      
    ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
    ->join('users as U','per.identificacion','=','U.identificacion')
    ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ",per.apellido2) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.horainicio','au.horafin','au.totaldias','au.totalhoras','emp.idempleado','U.email','au.idausencia')
    ->where('au.idausencia','=',$id)
    ->orderBy('au.idausencia','desc')
    ->first();

    $dias =DB::table('vacadetalle as va')
    ->join('empleado as emp','va.idempleado','=','emp.idempleado')
    ->join('persona as per','emp.identificacion','=','per.identificacion')
    ->join('ausencia as a','emp.idempleado','=','a.idempleado')        
    ->select('va.idempleado','va.idausencia','va.acuhoras','va.acudias','va.fecharegistro','va.idvacadetalle','va.solhoras','va.soldias','va.goce')
    ->where('va.idausencia','=',$id)
    ->first();

    return view('director.vacaciones.dconfirmar',["empleado"=>$empleado,"dias"=>$dias]);            
  }

  public function rechazado($id)
  {
    $empleado =DB::table('ausencia as au')
    ->join('empleado as emp','au.idempleado','=','emp.idempleado')
    ->join('persona as per','emp.identificacion','=','per.identificacion')
      
    ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
    ->join('users as U','per.identificacion','=','U.identificacion')
    ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ",per.apellido2) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.horainicio','au.horafin','au.totaldias','au.totalhoras','emp.idempleado','U.email','au.idausencia')
    ->where('au.idausencia','=',$id)
    ->first();
    //dd($empleado);

    $dias =DB::table('vacadetalle as va')
    ->join('empleado as emp','va.idempleado','=','emp.idempleado')
    ->join('persona as per','emp.identificacion','=','per.identificacion')
    ->join('ausencia as a','emp.idempleado','=','a.idempleado')        
    ->select('va.idempleado','va.idausencia','va.acuhoras','va.acudias','va.fecharegistro','va.idvacadetalle','va.solhoras','va.soldias','va.goce')
    ->where('va.idausencia','=',$id)
    ->first();

      return view('director.vacaciones.rechazado',["empleado"=>$empleado,"dias"=>$dias]);            
  }

    //Envio de respuesta de solicitud de vacaciones ya se autorizado o rechazado
  public function enviarvacaciones(Request $request)
  {
    $today = Carbon::now();
    $year = $today->format('Y');

    $this->validateRequest($request);      

    $codigo=$request->idausencia;
    $idempleado=$request->idempleado;
     
    $ausencia = Vacaciones::find($codigo);

    try 
    {
      DB::beginTransaction();
      $ausencia->observaciones = $request->observaciones;
      $ausencia->autorizacion = $request->autorizacion;
      $ausencia->id=Auth::user()->id;
      $ausencia->save();

      Mail::send('emails.envempermiso',$request->all(), function($msj) use ($request){
        $receptor = $request->receptor;
        $msj->subject('Respuesta de solicitud de vacaciones');
        $msj->to($receptor);
      });
      DB::commit();
    }catch (\Exception $e) 
    {
      DB::rollback();
      return response()->json(array('error' => 'No se ha podido enviar la respuesta de solicitud de vacaciones'),404);         
    }
    return response()->json($ausencia);
  }
    ///Envio de respuesta de solicitud de goce de vacaciones
  public function confirmavacaciones(Request $request)
  {
    $today = Carbon::now();
    $year = $today->format('Y');
      
    $this->validateRequest($request);      

    $codigo=$request->idausencia;
    $idvacadetalle=$request->idvacadetalle;
    $ausencia = Vacaciones::find($codigo);
    $vacadetalle=Vacadetalle::find($idvacadetalle);
    $idempleado=$request->idempleado;

    $autorizacion = $request->autorizacion;

    try 
    {
      DB::beginTransaction();
      $ausencia->observaciones = $request->observaciones;
      $ausencia->autorizacion = $request->autorizacion;
      //$ausencia->id=Auth::user()->id;
      $ausencia->save();

      if($autorizacion ==='Confirmado')
      {
        $vacadetalle->idausencia = $codigo;
        if($request->solhoras === "00:00:00")
        {
          $vacadetalle->solhoras = $request->solhoras;
        }

        elseif ($request->solhoras === "04:00:00") {
          $vacadetalle->solhoras = $request->solhoras;
        }
        else
        {
           $vacadetalle->solhoras = $request->solhoras.":00:00";
        } 
        $vacadetalle->soldias = $request->soldias;
        $vacadetalle->estado = 1;

        $vacadetalle->save();
      } 

      Mail::send('emails.envempermiso',$request->all(), function($msj) use ($request){
        $receptor = $request->receptor;
        $msj->subject('Confirmacion de goce vacaciones');
        $msj->setTo(array($receptor));
      });
      DB::commit();
    }catch (\Exception $e) 
    {
       DB::rollback();
       return response()->json(array('error' => 'No se ha podido enviar la respuesta de goce vacaciones'),404);         
    }
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
 
}
