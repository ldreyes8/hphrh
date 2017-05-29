<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UserFormRequest;
//use App\Vacaciones;

//use App\HPMEConstants;
use App\Http\Requests\PRequest;
use Validator;

use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use Mail;
use Session;

use App\Tausencia;
use App\Vacaciones;


class PController extends Controller
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

        $ausencias=DB::table('ausencia as a')
        ->join('empleado as emp','a.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->join('tipoausencia as ta','a.idtipoausencia','=','ta.idtipoausencia')
        ->select('a.fechainicio','a.fechafin','a.horainicio','a.horafin','a.juzgadoinstitucion','a.tipocaso','a.autorizacion','a.fechasolicitud')
        ->where('U.id','=',Auth::user()->id)
        ->where('ta.ausencia','!=','Vacaciones')

        ->groupBy('a.fechainicio','a.fechafin','a.horainicio','a.horafin','a.juzgadoinstitucion','a.tipocaso','a.autorizacion','a.fechasolicitud')
        
        ->paginate(15);
    	}

      $tausencia= Tausencia::orderBy('ausencia','ASC')
          ->select('idtipoausencia','ausencia')
          ->where('ausencia','!=','Vacaciones')
          ->get();

      $usuarios = DB::table('users as U')
          ->join('persona as per','U.identificacion','=','per.identificacion')
          ->join('empleado as E','per.identificacion','=','E.identificacion')
          ->join('municipio as M','per.idmunicipio','=','M.idmunicipio')
          ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ",per.apellido2) AS nombre'),'per.idmunicipio','E.idempleado')
          ->where('U.id','=',Auth::user()->id)
          ->first();


    	return view('empleado.permiso.index',["ausencias"=>$ausencias,"searchText"=>$query,"tausencia" => $tausencia,"usuarios"=>$usuarios]);
    }

    public function create()
    {
      #$roles=Rol::all();
      #dd(Rol::all());
      //$tausencia = tipoausencia

    	$tausencia= Tausencia::orderBy('ausencia','ASC')
      		->select('idtipoausencia','ausencia')
          ->where('ausencia','!=','Vacaciones')
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

  public function diashatomar(request $request)
  {
    $this->validateRequest($request);

    $today = Carbon::now();
    $days = 1;

    $fechainicio = $request->fecha_inicio;
    $fechafinal = $request->fecha_final;


    $today = $today->format('Y-m-d'); 
    $fechainicio = Carbon::createFromFormat('d/m/Y',$fechainicio);
    $fechafinal = Carbon::createFromFormat('d/m/Y',$fechafinal);

    $fini = $fechainicio;
    $ffin = $fechafinal;

    $fechainicio = $fechainicio->toDateString();
    $fechafinal = $fechafinal->toDateString();


    if($fechafinal >= $fechainicio){
  

      if ($fechainicio < $today) {
                return response()->json(array('error' => 'No se puede realizar esta accion'),404);
      }
      else{
        while ($ffin >= $fini) {
          if($fini != $ffin){
            if($fini->isWeekend() === false){ 
              $days++;
            }
            $fini->addDay();
          }
          else{
            break;
          }
        }
      }
      return response()->json(array($days));
    }
    else{
      return response()->json(array('error'=>'la fecha inicio no puede ser mayor que la fecha final'),404);
    }
  }

  public function store(request $request)
  {
    $this->validateRequest($request);
    $vacaciones = new Vacaciones;
      
    $fechainicio = $request->fecha_inicio; 
    $fechafinal = $request->fecha_final;
    $concurrencia = $request->concurrencia;

    $hini = $request->hini;
    $hfin = $request->hfin;
    $mini = $request->mini;
    $mfin = $request->mfin;

    $name = $request->name;

    $horainicio = $hini.':'.$mini;
    $horafinal = $hfin.':'.$mfin;

    $today = Carbon::now();
    	
    $today = $today->format('Y-m-d'); 
    $fechainicio = Carbon::createFromFormat('d/m/Y',$fechainicio);
    $fechafinal = Carbon::createFromFormat('d/m/Y',$fechafinal);

    $fini = $fechainicio;
    $ffin = $fechafinal;


    $fechainicio = $fechainicio->toDateString();
    $fechafinal = $fechafinal->toDateString();

    if($fechafinal >= $fechainicio)
    {
      if($hfin < $hini)
      {
        return response()->json(array('error' => 'Hora inicial debe ser menor a la hora final'),404);
      }

      $hinicio = $hini*60;
      $hinicio = $hinicio + $mini;

      $hfinal = $hfin * 60;
      $hfinal = $hfinal + $mfin;

      if($hinicio > $hfinal)
      {
        return response()->json(array('error' => 'Verificar la hora y minutos solicitados'),404);                  
      }
      else
      {
        //try 
        //{
        //  DB::beginTransaction();

          $idempleado = $request->idempleado;
          $idtipoausencia = $request->idtipoausencia;        

          if($idtipoausencia === '4')
          {
            $factual = Carbon::now();
            $year = $factual->format('Y');
                
            $inicioaño = $year.'-01-01';  
            $finaño = $year.'-12-31';
            $ausencias=DB::table('ausencia as a')
            ->join('empleado as emp','a.idempleado','=','emp.idempleado')
            ->join('tipoausencia as ta','a.idtipoausencia','=','ta.idtipoausencia')
            ->select('a.autorizacion','a.fechasolicitud',DB::raw('SUM(a.totaldias) as total'),DB::raw('SUM(a.totalhoras) as thora'))
            ->groupBy('a.autorizacion','a.fechasolicitud')
            ->where('a.idempleado','=',$idempleado)
            ->where('ta.ausencia','=','Enfermedad')
            ->where('a.fechasolicitud', '>=', $inicioaño)
            ->where('a.fechasolicitud', '<=', $finaño)
            ->where('a.autorizacion','=','Confirmado')
            ->get();

            $tho =0;
            $total =0;

            
              foreach ($ausencias as $aus) { 
                $total = $aus->total;
                $tho = $aus->thora;
              }
            

            $tho = $tho/10000;

            $total = $total *8; 
            $tdia = $tho + $total; 

            if($tdia >= '24')
            {
              return response()->json(array('error'=>'No puede solicitar permiso "por enfermedad" usted ha agotado los días autorizados en el año'),404);
            }
            else
            {
              $day = 1;
              while ($ffin >= $fini) {
                if($fini != $ffin){
                  if($fini->isWeekend() === false){ 
                    $day++;
                  }
                  $fini->addDay();
                }
                else{
                   break;
                }
              }
              $day = $day * 8;
              $tday = $day + $tdia;

              if($tday > '24')
              {
                $resto = 24- $tdia;
                $resto = $resto / 8;

                if ($resto - floor($resto) == 0) {
                  $resto = $resto. " Días";
                }
                else{
                  $resto = $resto - 0.5;
                  $resto = $resto." Días"." ½ ";
                }
                return response()->json(array('error'=>'No puede solicitar permiso "por enfermedad" usted tiene de saldo '. $resto),404);                      
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
                $vacaciones->totaldias = $request->dias;
                $vacaciones->totalhoras = $request->horas.':00:00';
                //dd($request->all());
                $mytime = Carbon::now('America/Guatemala');
                $vacaciones->fechasolicitud=$mytime->toDateString();
                $vacaciones->save();
              }
            }
          }

          else
          {
            $vacaciones->fechainicio = $fechainicio;
            $vacaciones->fechafin = $fechafinal;
            $vacaciones->horainicio=$horainicio;
            $vacaciones->horafin=$horafinal;
            $vacaciones->juzgadoinstitucion= $request->get('juzgadoinstitucion');
            $vacaciones->tipocaso= $request->get('tipocaso');
            $vacaciones->idempleado = $request->idempleado;
            $vacaciones->idmunicipio = $request->idmunicipio;
            $vacaciones->idtipoausencia= $request->idtipoausencia;
            $vacaciones->concurrencia = $request->get('concurrencia');
            $vacaciones->autorizacion='solicitado';
            $vacaciones->totalhoras = '00:00:00';
            //dd($request->all());
            $mytime = Carbon::now('America/Guatemala');
            $vacaciones->fechasolicitud=$mytime->toDateString();
            $vacaciones->save();
          }
          $idausencia = $vacaciones->idausencia;

          if($concurrencia === 'No')
          {
            $vac =DB::table('ausencia as au')                
            ->select(DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, au.horainicio, au.horafin)) as horas'))
            ->orderBy('au.idausencia','des')
            ->first();

            if($idtipoausencia === '7')
            {
              $days = 1;
              while ($ffin >= $fini) {
                if($fini != $ffin){
                  if($fini->isWeekend() === false){ 
                    $days++;
                  }
                  $fini->addDay();
                }
                else{
                  break;
                }
              }
            }

            if($vac->horas < 8)
            {
              $days = 0;
            }
            if($idtipoausencia !== "4")
            {
              $vacacion = Vacaciones::findOrFail($idausencia);
              $vacacion->totalhoras = $vac->horas;
              $vacacion->totaldias = $days; 
              $vacacion->update();
            }                  

            Mail::send('emails.envio',$request->all(), function($msj) use ($request){
              $idpersona = DB::table('empleado as e')
              ->join('persona as p','e.identificacion','=','p.identificacion')
              ->join('users as U','p.identificacion','=','U.identificacion')
              ->select('e.idempleado')
              ->where('U.id','=',Auth::user()->id)
              ->first();

              $emisor =DB::table('asignajefe as aj')
              ->join('persona as p','aj.identificacion','=','p.identificacion')
              ->join('users as U','U.identificacion','=','p.identificacion')
              ->join('empleado as e','e.idempleado','=','aj.idempleado')
              ->select('U.email')
              ->where('aj.notifica','=','1')
              ->where('aj.idempleado','=',$idpersona->idempleado)
              ->get();        
              
              foreach ($emisor as $per) {
                $msj->subject('Solicitud de vacaciones');
                $msj->to($per->email);
              }
                  
              //$msj->to('drdanielreyes5@gmail.com');
            });
          }
          //DB::commit();
          
              
        //}catch (\Exception $e) 
        //{
         //DB::rollback();         
        //}
      }
    }
    else{
      return response()->json(array('error'=>'la fecha inicio no puede ser mayor que la fecha final'),404);
    }
    return response()->json($vacaciones);      	     
  }

  public function validateRequest($request){
    $rules=[
      'fecha_inicio'=>'required',
      'fecha_final'=>'required',
      ];
        
    $messages=[
      'required' => 'Debe ingresar :attribute.',
      'max'  => 'La capacidad del campo :attribute es :max',
    ];
    $this->validate($request, $rules,$messages);        
  }
}

/*
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
        }*/