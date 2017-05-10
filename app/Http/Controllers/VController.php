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
        ->join('vacadetalle as vd','a.idausencia','=','vd.idausencia')
        ->select('a.fechainicio','a.fechafin','a.autorizacion','a.fechasolicitud','a.totaldias','a.totalhoras')
        ->where('U.id','=',Auth::user()->id)
        ->groupBy('a.fechainicio','a.fechafin','a.autorizacion','a.fechasolicitud','a.totaldias','a.totalhoras')
        
        ->paginate(15);
      }
      return view('empleado.vacaciones.index',["ausencias"=>$ausencias,"searchText"=>$query]);
  }
    
  public function create()
  {
    #$roles=Rol::all();
    #dd(Rol::all());
    //$tausencia = tipoausencia

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
  public function store(request $request)
  {

 $this->validateRequest($request);      

    $vacaciones = new Vacaciones;
    $mytime = Carbon::now('America/Guatemala');
    $fechainicio = $request->fechainicio;
    $fechafinal = $request->fechafin;

    $today = Carbon::now();
    $days = 1;

    $year = $today->format('Y');

    //$year = $year->dayOfYear;

    $add = $today->dayOfYear;
    dd($add,$year);

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

  public function validateRequest($request){
        $rules=[
          'fechainicio'=>'required',
          'fechafin'=>'required',

        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }

}