<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UserFormRequest;
use App\Vacaciones;
use App\Tausencia;
//use App\HPMEConstants;
use App\Http\Requests\VRequest;
use Validator;

use Carbon\Carbon;  // para poder usar la fecha y hora
use Illuminate\Support\Facades\Auth; 

use DB;
use Mail;

class VController extends Controller
{
  public function index(request $request)
  {
    if ($request)
      {
        $query=trim($request->get('searchText'));

        $ausencias=DB::table('ausencia as a')
        ->join('empleado as emp','a.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('a.fechainicio','a.fechafin','a.autorizacion','a.fechasolicitud','a.totaldias','a.totalhoras')
        ->join('tipoausencia as ta','a.idtipoausencia','=','ta.idtipoausencia')
        ->where('U.id','=',Auth::user()->id)
        ->where('ta.ausencia','=','Vacaciones')
        ->groupBy('a.fechainicio','a.fechafin','a.autorizacion','a.fechasolicitud','a.totaldias','a.totalhoras')
        
        ->paginate(15);
      }

      $usuarios = DB::table('users as U')
          ->join('persona as per','U.identificacion','=','per.identificacion')
          ->join('empleado as E','per.identificacion','=','E.identificacion')
          ->join('municipio as M','per.idmunicipio','=','M.idmunicipio')
          ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ",per.apellido2) AS nombre'),'per.idmunicipio','E.idempleado')
          ->where('U.id','=',Auth::user()->id)
          ->first();

      return view('empleado.vacaciones.index',["ausencias"=>$ausencias,"searchText"=>$query,'usuarios'=>$usuarios]);
  }
    
  public function create()
  {
    $vacaciones= DB::table('vacadetalle as vd')
      ->select('vd.acuhoras')
      ->where('vd.idempleado','=','1')
      ->orderBy('vd.idvacadetalle','des')
      ->first();
        
    $tausencia= Tausencia::orderBy('ausencia','ASC')
      ->select('idtipoausencia','ausencia')
      ->get();

    $empleado = DB::table('empleado as emp')
      ->join('persona as per','emp.identificacion','=','per.identificacion')
      ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'))
      ->where('emp.idempleado','=','1')
      ->get();

    return view('empleado.vacaciones.create',array('tausencia' => $tausencia,'empleado'=>$empleado,'vacaciones'=>$vacaciones));
  }

  public function calculardias(request $request)
  {
    $dias =DB::table('vacadetalle as va')
        ->join('empleado as emp','va.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('va.idempleado','va.idausencia','va.acuhoras','va.acudias','va.fecharegistro')
        ->where('U.id','=',Auth::user()->id)
        ->first();

    $fecharegistro = $dias->fecharegistro;    
    $diasactual = $dias->acudias;   //obtiene la ultima fecha en donde se registro un nuevo registro
    $horasactual = $dias->acuhoras;
    

    $dt = Carbon::parse($fecharegistro);  // convertimos la fecha en el formato Y-mm-dddd h:i:s
    $today = Carbon::now();
    
    $year = $today->format('Y');


    if((($year%4 == 0) && ($year%100)) || $year%400 == 0)
    {$year = 366;}
    else{$year = 365;}

    $ftoday = $today->toDateString();

   
    if($fecharegistro > $ftoday)
    {
      $thoras = 0;
      $dias = 0;

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
      $thoras = $tdia[1];

      $thoras = '0.'.$thoras;
      $thoras = $thoras * 8;

      $thora = explode(".",$thoras);
      $thoras = $thora[0];

      $thoras = $horasactual + $thoras;
      $dias = $diasactual + $dias; 

      if($thoras >= 8)
      {
        $thoras = $thoras -8;
        $dias = $dias +1;
      }      
    }

    $calculo = array($thoras,$dias);
    return response()->json($calculo);
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
      if($fechainicio === $today){
        return response()->json(array('error' => 'Fecha inicio no puede ser igual ala fecha actual'),404);
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
/*
  public function store(request $request)
  {
    $this->validateRequest($request);
     $total = 3527.20;
     $decimales = explode(".",$total);
     $entero = $decimales[0];
     $decimal = $decimales[1];

    $vacaciones = new Vacaciones;
    $mytime = Carbon::now('America/Guatemala');
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
      if($fechainicio === $today){
        return response()->json(array('error' => 'Fecha inicio no puede ser igual ala fecha actual'),404);
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
                dd($days);
            break;
          }
        }
      }
      return response()->json(["valid" => true], 200);
    }
    else{
      return response()->json(array('error'=>'la fecha inicio no puede ser mayor que la fecha final'),404);
    }
    return response()->json($vacaciones);
  }
*/
  public function store(request $request)
  {
    $this->validateRequest($request);
    $vacaciones = new Vacaciones;
    $fechainicio = $request->fecha_inicio; 
    $fechafinal = $request->fecha_final;

    $fechainicio = Carbon::createFromFormat('d/m/Y',$fechainicio);
    $fechafinal = Carbon::createFromFormat('d/m/Y',$fechafinal);

    $fechainicio = $fechainicio->toDateString();
    $fechafinal = $fechafinal->toDateString();
    

    $vacaciones->fechainicio = $fechainicio;
    $vacaciones->fechafin = $fechafinal;
    $vacaciones->horainicio = '00:00:00';
    $vacaciones->horafin = '00:00:00';
    $vacaciones->idempleado = $request->idempleado;
    $vacaciones->idmunicipio = $request->idmunicipio;
    $vacaciones->totaldias = $request->dias;
    $vacaciones->totalhoras = $request->horas;
    $vacaciones->autorizacion='solicitado';
    $mytime = Carbon::now('America/Guatemala');
    $vacaciones->fechasolicitud=$mytime->toDateString();
    $vacaciones->idtipoausencia= '3';

    $vacaciones->save();

    Mail::send('emails.envio',$request->all(), function($msj){


              $emisor =DB::table('ausencia as au')
              ->join('empleado as emp','au.idempleado','=','emp.idempleado')
              ->join('persona as p','emp.identificacion','=','p.identificacion')
              ->join('jefesinmediato as jf','emp.idjefeinmediato','=','jf.idjefeinmediato')
              ->join('users as U','p.identificacion','=','U.identificacion')
              ->select('jf.email')
              ->where('U.id','=',Auth::user()->id)
              ->first();

                $msj->subject('Solicitud de vacaciones');
                $msj->to($emisor->email);
                //$msj->to('drdanielreyes5@gmail.com');
              });

    return response()->json($vacaciones);
  }

/*
  public function store(request $request)
  {
    $this->validateRequest($request);      

    $vacaciones = new Vacaciones;
    $mytime = Carbon::now('America/Guatemala');
    $fechainicio = $request->fechainicio;
    $fechafinal = $request->fechafin;

    $today = Carbon::now();
    $days = 1;

    $today = $today->format('Y-m-d'); 
    $fechainicio = Carbon::createFromFormat('d/m/Y',$fechainicio);
    $fechafinal = Carbon::createFromFormat('d/m/Y',$fechafinal);
  
    $fini = $fechainicio;
    $ffin = $fechafinal;

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
          else{
            while ($ffin >= $fini) {
              if($fini != $ffin){
                if($fini->isWeekend() === false){ 
                  $days++;
                }
                $fini->addDay();
              }
              else{
                //dd($days);
                break;
              }
            }
          }
          return response()->json(["valid" => true], 200);
        }
        else{
          return response()->json(array('error'=>'la fecha inicio no puede ser mayor que la fecha final'),200);
        }
      }
      else
      {
        if($fechafinal >= $fechainicio){
          if($fechainicio === $today){
            return Redirect('empleado/vacaciones')
            ->with('message','La fecha inicio no puede ser igual a la fecha actual');
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
                //dd($days);
                break;
              }
            }
          }
          dd($days,$fini,$ffin);
          return Redirect('empleado/vacaciones')
          ->with('message','Envio correctamente');
          $request->input('fechainicio');
          $request->input('fechafin');
        }
        else{
          return Redirect('empleado/vacaciones')
          ->with('message','La fecha inicio debe ser antes que la fecha final');                
        }         
      }
    }     
  }
*/
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