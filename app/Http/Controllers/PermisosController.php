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

        $usuarios = DB::table('users as U')
        ->join('persona as per','U.identificacion','=','per.identificacion')
        ->join('empleado as emp','per.identificacion','=','emp.identificacion')
        ->join('jefesinmediato as jf','per.identificacion','=','jf.identificacion')
        ->select('jf.idjefeinmediato')
        ->where('U.id','=',Auth::user()->id)
        ->first();

        $permisos =DB::table('ausencia as au')
        ->join('empleado as emp','au.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('jefesinmediato as jf','emp.idjefeinmediato','=','jf.idjefeinmediato')
        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
        
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ",per.apellido2) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia')
        ->where('emp.idjefeinmediato','=',$usuarios->idjefeinmediato)
        ->where('au.autorizacion','=','solicitado')        
        ->paginate(15);
    	}

    	return view('director.permisos.index',["permisos"=>$permisos,"searchText"=>$query]);
    }

    public function indexconfirmado (Request $request)
    {
        $usuarios = DB::table('users as U')
        ->join('persona as per','U.identificacion','=','per.identificacion')
        ->join('empleado as emp','per.identificacion','=','emp.identificacion')
        ->join('jefesinmediato as jf','per.identificacion','=','jf.identificacion')
        ->select('jf.idjefeinmediato')
        ->where('U.id','=',Auth::user()->id)
        ->first();

        $permisos =DB::table('ausencia as au')
        ->join('empleado as emp','au.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('jefesinmediato as jf','emp.idjefeinmediato','=','jf.idjefeinmediato')
        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
        
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ",per.apellido2) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia')
        ->where('emp.idjefeinmediato','=',$usuarios->idjefeinmediato)
        ->where('au.autorizacion','=','Confirmado')        
        ->paginate(15);

        return view('director.permisos.indexconfirmado',["permisos"=>$permisos])  ;        
    }

     public function indexrechazado (Request $request)
    {
        $usuarios = DB::table('users as U')
        ->join('persona as per','U.identificacion','=','per.identificacion')
        ->join('empleado as emp','per.identificacion','=','emp.identificacion')
        ->join('jefesinmediato as jf','per.identificacion','=','jf.identificacion')
        ->select('jf.idjefeinmediato')
        ->where('U.id','=',Auth::user()->id)
        ->first();
        
        $permisos =DB::table('ausencia as au')
        ->join('empleado as emp','au.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('jefesinmediato as jf','emp.idjefeinmediato','=','jf.idjefeinmediato')
        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
        
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ",per.apellido2) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.idausencia')
        ->where('emp.idjefeinmediato','=',$usuarios->idjefeinmediato)
        ->where('au.autorizacion','=','Rechazado')        
        ->paginate(15);

        return view('director.permisos.indexrechazado',["permisos"=>$permisos])  ;        
    }

    public function verificar($id)
    {
      $empleado =DB::table('ausencia as au')
        ->join('empleado as emp','au.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('jefesinmediato as jf','emp.idjefeinmediato','=','jf.idjefeinmediato')
        ->join('tipoausencia as tp','au.idtipoausencia','=','tp.idtipoausencia')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ",per.apellido2) AS nombre'),'per.identificacion','au.fechasolicitud','tp.ausencia','au.fechainicio','au.fechafin','au.horainicio','au.horafin','au.totaldias','au.totalhoras','au.concurrencia','emp.idempleado','U.email','au.idausencia')
        ->where('au.idausencia','=',$id)
        ->first();
      //dd($empleado);
      return view('director.permisos.detalle',["empleado"=>$empleado]);            
    }

    public function enviarpermiso(Request $request)
    {
      $this->validateRequest($request);      

      $codigo=$request->idausencia;
     
      $ausencia = Vacaciones::find($codigo);

      $ausencia->observaciones = $request->observaciones;
      $ausencia->autorizacion = $request->autorizacion;
      $ausencia->save();

      

      Mail::send('emails.envioempleado',$request->all(), function($msj) use ($request){
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

    /*
    public function create()
    {
      #$roles=Rol::all();
      #dd(Rol::all());
      //$tausencia = tipoausencia

    	$tausencia= Tausencia::orderBy('ausencia','ASC')
      		->select('idtipoausencia','ausencia')
      		->get();

      $usuarios = DB::table('users as U')
          ->join('persona as per','U.identificacion','=','per.identificacion')
          ->join('empleado as E','per.identificacion','=','E.identificacion')
      	  ->join('municipio as M','per.idmunicipio','=','M.idmunicipio')
      	  ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ",per.apellido2) AS nombre'),'per.idmunicipio','E.idempleado')
          ->where('U.id','=',Auth::user()->id)
          ->first();

		  return view('empleado.permiso.create',array('tausencia' => $tausencia,'usuarios'=>$usuarios));
  	}

  	public function store(PRequest $request)
  	{
    	$vacaciones = new Vacaciones;
      
    	$fechainicio = $request->fini; 
    	$fechafinal = $request->ffin;
      $concurrencia = $request->concurrencia;

      $hini = $request->horainicio;
      $hfin = $request->horafin;
      $mini = $request->mini;
      $mfin = $request->mfin;

      $name = $request->name;

      $horainicio = $hini.':'.$mini;
      $horafinal = $hfin.':'.$mfin;

      $today = Carbon::now();
    	

    	$today = $today->format('Y-m-d'); 
    	$fechainicio = Carbon::createFromFormat('d/m/Y',$fechainicio);
    	$fechafinal = Carbon::createFromFormat('d/m/Y',$fechafinal);

    	$fechainicio = $fechainicio->toDateString();
    	$fechafinal = $fechafinal->toDateString();
      
    	$validator = Validator::make(
      	$request->all(), 
      	$request->rules(),
      	$request->messages()
    	);

    	if ($validator->valid())
    	{
      	if ($request->ajax()){
        	if($fechafinal >= $fechainicio){
          	if($fechainicio === $today){
            	return response()->json(array('error' => 'Fecha inicio no puede ser igual ala fecha actual'),200);
            }

            if($hfin < $hini)
            {
              return response()->json(array('error' => 'Hora inicial debe ser menor a la hora final'),200);
            }

            $hinicio = $hini*60;
            $hinicio = $hinicio + $mini;

            $hfinal = $hfin * 60;
            $hfinal = $hfinal + $mfin;

            if($hinicio > $hfinal)
            {
              return response()->json(array('error' => 'Verificar la hora y minutos solicitados'),200);                  
            }
            else
            {
              $vacaciones->fechainicio = $fechainicio;
              $vacaciones->fechafin = $fechafinal;
              $vacaciones->horainicio=$horainicio;
              $vacaciones->horafin=$horafinal;
              $vacaciones->juzgadoinstitucion= $request->get('juzgadoinstitucion');
              $vacaciones->tipocaso= $request->get('tipocaso');
              $vacaciones->idempleado = $request->get('idempleado');
              $vacaciones->idmunicipio = $request->get('idmunicipio');
              $vacaciones->idtipoausencia= $request->get('idtipoausencia');
              $vacaciones->concurrencia = $request->get('concurrencia');
              $vacaciones->autorizacion='solicitado';
              $vacaciones->totalhoras = '00:00:00';

              //dd($request->all());
              $mytime = Carbon::now('America/Guatemala');
              $vacaciones->fechasolicitud=$mytime->toDateString();
              $vacaciones->save();
                
              $idausencia = $vacaciones->idausencia;

              if($concurrencia === 'No')
              {
                $vac =DB::table('ausencia as au')                
                ->select(DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, au.horainicio, au.horafin)) as horas'))
                ->orderBy('au.idausencia','des')
                ->first();

                $vacacion = Vacaciones::findOrFail($idausencia);
                $vacacion->totalhoras = $vac->horas;
                $vacacion->update();                  
              }

              //dd($request->all());


              //dd($emisor);


              Mail::send('emails.envio',$request->all(), function($msj){


              $emisor =DB::table('ausencia as au')
              ->join('empleado as emp','au.idempleado','=','emp.idempleado')
              ->join('persona as p','emp.identificacion','=','p.identificacion')
              ->join('jefesinmediato as jf','emp.idjefeinmediato','=','jf.idjefeinmediato')
              ->join('users as U','p.identificacion','=','U.identificacion')
              ->select('jf.email')
              ->where('U.id','=',Auth::user()->id)
              ->first();

                $msj->subject('Solicitud de permiso');
                $msj->to($emisor->email);
                //$msj->to('drdanielreyes5@gmail.com');
              });
          		return response()->json(["valid" => true], 200);
            }
        	}
        	else{
          	return response()->json(array('error'=>'la fecha inicio no puede ser mayor que la fecha final'),200);
        	}
      	}
      	else
      	{
        	if($fechafinal >= $fechainicio){
          	if($fechainicio === $today){
          		return Redirect('empleado/permiso')
            	->with('message','La fecha inicio no puede ser igual a la fecha actual');
          		}
          			//dd($days,$fini,$ffin);
          		return Redirect('empleado/permiso')
          		->with('message','Envio correctamente');
          		$request->input('fechainicio');
          		$request->input('fechafin');
        	}
        	else{
          	return Redirect('empleado/permiso')
          	->with('message','La fecha inicio debe ser antes que la fecha final');                
        	}         
      	}
    	}     
  	}
  	*/
}
