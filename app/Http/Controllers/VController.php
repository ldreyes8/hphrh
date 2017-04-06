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


use DB;
class VController extends Controller
{
    public function index()
  {

  }
    
  public function create()
  {
        #$roles=Rol::all();
        #dd(Rol::all());
        //$tausencia = tipoausencia

    $vacaciones= DB::table('vacadetalle as vd')
      ->select('vd.acumulado')
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
  public function store(VacacionRequest $request)
  {
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
}