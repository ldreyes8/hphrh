<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UserFormRequest;
use App\Vacaciones;
use App\Vacadetalle;
use App\Tausencia;
//use App\HPMEConstants;
use App\Http\Requests\VRequest;
use Validator;

use Carbon\Carbon;  // para poder usar la fecha y hora
use Illuminate\Support\Facades\Auth; 

use DB;
use PDF;

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
        ->join('tipoausencia as ta','a.idtipoausencia','=','ta.idtipoausencia')
        ->join('vacadetalle as vd','a.idausencia','=','vd.idausencia')
        ->select('a.fechainicio','a.fechafin','a.autorizacion','a.fechasolicitud','a.totaldias','a.totalhoras',DB::raw('sum(a.totaldias - vd.soldias) as diastomados'),DB::raw('sum(a.totalhoras - vd.solhoras) as htomado'))
        
        ->where('U.id','=',Auth::user()->id)
        ->where('ta.ausencia','=','Vacaciones')
        ->groupBy('a.fechainicio','a.fechafin','a.autorizacion','a.fechasolicitud','a.totaldias','a.totalhoras')
        ->orderBy('a.fechasolicitud','desc')
        ->paginate(15);
              //DB::raw('DATE_FORMAT(account.terminationdate,"%Y-%m-%d") as accountterminationdate')
        // DB::raw('ABS(ledger.OpeningBalance) as openingBalance')

      }

      $vacaciones=DB::table('vacadetalle as vd')
        ->join('empleado as emp','vd.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('vd.acuhoras','vd.acudias','vd.solhoras','vd.soldias','vd.idvacadetalle')
        ->groupBy('vd.acuhoras','vd.acudias','vd.solhoras','vd.soldias','vd.idvacadetalle')
        ->orderBy('vd.idvacadetalle','DESC')
        ->first();
        

       $ausencia=DB::table('ausencia as a')
        ->join('empleado as emp','a.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->join('vacadetalle as vd','a.idausencia','=','vd.idausencia')
        ->select('a.totaldias','a.totalhoras','vd.idvacadetalle')
        ->join('tipoausencia as ta','a.idtipoausencia','=','ta.idtipoausencia')
        ->where('U.id','=',Auth::user()->id)
        ->where('ta.ausencia','=','Vacaciones')
        ->orderBy('vd.idvacadetalle','DESC')
        ->first();

      $usuarios = DB::table('users as U')
          ->join('persona as per','U.identificacion','=','per.identificacion')
          ->join('empleado as E','per.identificacion','=','E.identificacion')
          ->join('municipio as M','per.idmunicipio','=','M.idmunicipio')
          ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1," ") AS nombre'),'per.idmunicipio','E.idempleado')
          ->where('U.id','=',Auth::user()->id)
          ->first();


      return view('empleado.vacaciones.index',["ausencias"=>$ausencias,"searchText"=>$query,'usuarios'=>$usuarios,'ausencia'=>$ausencia,'vacaciones'=>$vacaciones]);
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

    $usuario = DB::table('users as U')
    ->join('persona as per','U.identificacion','=','per.identificacion')
    ->join('empleado as emp','per.identificacion','=','emp.identificacion')
    ->select('emp.idempleado')
    ->where('U.id','=',Auth::user()->id)
    ->first();

   

    $dias =DB::table('vacadetalle as va')
    ->join('empleado as emp','va.idempleado','=','emp.idempleado')
    ->join('persona as per','emp.identificacion','=','per.identificacion')
    ->select('va.idempleado','va.idausencia','va.acuhoras','va.acudias','va.fecharegistro','va.idvacadetalle','va.solhoras','va.soldias') 
    ->where('emp.idempleado','=',$usuario->idempleado)
    ->where('va.estado','=','1')
    ->orderBy('va.idvacadetalle','desc')
    ->first();

    $ausencia= DB::table('ausencia as a')
    ->join('empleado as emp','a.idempleado','=','emp.idempleado')
    ->join('persona as per','emp.identificacion','=','per.identificacion')
    ->join('users as U','per.identificacion','=','U.identificacion')
    ->select('a.autorizacion')
    ->orderBy('a.idausencia','DESC')
    ->where('idtipoausencia','=','3')
    ->where('U.id','=',Auth::user()->id)
    ->first();


    if($ausencia === null)
    {
      $autorizacion = "ninguno";
    }
    else
    {
      $autorizacion = $ausencia->autorizacion;
    }

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

    
   
    if($fecharegistro >= $ftoday)
    {
      $thoras = $horasactual + $horasol;
      $dias = $diasactual + $diasol; 

       if($thoras >= 8)
      {
        $thoras = $thoras -8;
        $dias = $dias +1;
      }


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

        $thoras = $horasactual + $thoras + $horasol;
        $dias = $diasactual + $dias + $diasol; }

        if($thoras >= 8)
        {
          $thoras = $thoras -8;
          $dias = $dias +1;
        }      
      }

    $calculo = array($thoras,$dias,$autorizacion);
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

      elseif ($fechainicio < $today) {
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
    $vacadetalle= new Vacadetalle;
    try 
    {
      DB::beginTransaction();
  

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
      $vacaciones->totalhoras = $request->horas.':00:00';
      $vacaciones->autorizacion='solicitado';
      $mytime = Carbon::now('America/Guatemala');
      $vacaciones->fechasolicitud=$mytime->toDateString();
      $vacaciones->idtipoausencia= '3';

      $vacaciones->save();

      //Vaca detalle.

      $today = Carbon::now();
      $year = $today->format('Y');
      //$fecha=Carbon::createFromFormat('d/m/Y',$today);


      $this->validateRequest($request);      

      $codigo=$vacaciones->idausencia;
  
     
      $vacadetalle=new Vacadetalle;


      $hdisponible = $request->thoras;
      $hdisponible = '0'.$hdisponible.':'.'00'.':'.'00';
      $ddisponible = $request->tdias;
      $hatomar = $request->horas;

      $hatomar = $hatomar.':'.'00'.':'.'00';

      $datomar = $request->dias;

      if($hatomar > $hdisponible)
      {
        $hdisponible = 8 + $hdisponible;
        $hdisponible = $hdisponible - $hatomar;
        $ddisponible = $ddisponible -1;
        $ddisponible = $ddisponible - $datomar;
        $hdisponible = '0'.$hdisponible.':'.'00'.':'.'00';
    
      }
      else{     

        $hdisponible = $hdisponible - $hatomar;
        $hdisponible = '0'.$hdisponible.':'.'00'.':'.'00';

        $ddisponible = $ddisponible - $datomar;
        
      }
 
      $vacadetalle->idempleado = $request->idempleado;;
      $vacadetalle->idausencia = $codigo;
      $vacadetalle->periodo = $year;
      $vacadetalle->acuhoras = $hdisponible;
      $vacadetalle->acudias =  $ddisponible;
      $vacadetalle->solhoras = '00:00:00';
      $vacadetalle->soldias = 0;
      $vacadetalle->estado = 0;
      $mytime = Carbon::now('America/Guatemala');
      $vacadetalle->fecharegistro=$mytime->toDateString();
       
      $vacadetalle->save();

      $name = $request->name;

      $url = url('empleado/vverificar/'.$codigo);
      $calculo = array($name,$url);
      

      Mail::send('emails.envacaciones',['calculo' => $calculo], function($msj) use ($request){

        $empleado = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as U','p.identificacion','=','U.identificacion')
        ->select('e.idempleado')
        ->where('U.id','=',Auth::user()->id)
        ->first();
    
        $idpersona = DB::table('asignajefe as aj')
          ->join('persona as p','aj.identificacion','=','p.identificacion')
          ->join('users as U','U.identificacion','=','p.identificacion')
          ->join('empleado as e','e.idempleado','=','aj.idempleado')
          ->select('U.email')
          ->where('aj.notifica','=','1')
          ->where('aj.idempleado','=',$empleado->idempleado)
          ->get();
        foreach ($idpersona as $per) {
          $msj->subject('Solicitud de vacaciones');
          $msj->to($per->email);
        }
    
      });
    DB::commit();
    }catch (\Exception $e) 
    {
      DB::rollback();
      return response()->json(array('error' => 'No se ha podido enviar la solicitud'),404);         
    }
    return response()->json($vacaciones);
  }

  public function update(request $request)
  {
    $idausencia = $request->idausencia;    
    $idempleado = $request->idempleado;
    $idvacadetalle = $request->idvacadetalle;

    $vacaciones = vacadetalle::find($idvacadetalle);

    $ausencia = DB::table('ausencia as a')
    ->join('vacadetalle as vd','a.idausencia','=','vd.idausencia')
    ->select('a.idausencia')
    ->where('vd.idvacadetalle','=',$idvacadetalle)
    ->first();

   
    $va = $ausencia->idausencia;
    try 
    {
      DB::beginTransaction();

      if($request->goce ==="No_gozado")
      {
        $vacaciones->solhoras= $request->solhoras;
        $vacaciones->soldias=$request->soldias; 
        $vacaciones->goce=$request->goce;
        $vacaciones->estado = '0';
        $vacaciones->observaciones = $request->observaciones;      
      }
      else
      {
        $vacaciones->solhoras= $request->solhoras;
        $vacaciones->soldias=$request->soldias; 
        $vacaciones->goce=$request->goce;
        $vacaciones->observaciones = $request->observaciones;
      }

      $name = $request->name;
      $url = url('empleado/vconfirmar/'.$va);

      $calculo = array($name,$url);


      $vacaciones->save();

      Mail::send('emails.envautorizacion',['calculo' => $calculo], function($msj) use ($request){

        $empleado = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as U','p.identificacion','=','U.identificacion')
        ->select('e.idempleado')
        ->where('U.id','=',Auth::user()->id)
        ->first();
    
        $idpersona = DB::table('asignajefe as aj')
          ->join('persona as p','aj.identificacion','=','p.identificacion')
          ->join('users as U','U.identificacion','=','p.identificacion')
          ->join('empleado as e','e.idempleado','=','aj.idempleado')
          ->select('U.email')
          ->where('aj.notifica','=','1')
          ->where('aj.idempleado','=',$empleado->idempleado)
          ->get();

        foreach ($idpersona as $per) {
          $msj->subject('Solicitud de goce vacaciones');   
          $msj->to($per->email);
        }
      });
      DB::commit();
    }catch (\Exception $e) 
    {
      DB::rollback();
      return response()->json(array('error' => 'No se ha podido enviar la solicitud'),404);         
    }
    
    return response()->json($vacaciones);
  }

  public function goce(request $request)
  {
    $usuario = DB::table('users as U')
    ->join('persona as per','U.identificacion','=','per.identificacion')
    ->join('empleado as emp','per.identificacion','=','emp.identificacion')
    ->join('nomytras as nom','emp.idempleado','=','nom.idempleado')
    ->join('puesto as pue','nom.idpuesto','=','pue.idpuesto')
    ->join('afiliado as afi','nom.idafiliado','=','afi.idafiliado')
    ->select('emp.idempleado','per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','pue.nombre as puesto','afi.nombre as afiliado')
    ->where('U.id','=',Auth::user()->id)
    ->orderBy('nom.idnomytas','desc')
    ->first();

    $today = Carbon::now();
    $year = $today->format('d/m/Y');



    //return view('empleado.vacaciones.index',["ausencias"=>$ausencias,"searchText"=>$query,'usuarios'=>$usuarios,'ausencia'=>$ausencia,'vacaciones'=>$vacaciones]); 
    return view ('reporte.gocevacaciones',["usuario"=>$usuario,"year"=>$year]);
    /*
      $pdf= PDF::loadView('reporte.gocevacaciones');
        return $pdf->download('reporte.pdf'); */
  }

  public function rangogoce(request $request)
  {
    $this->validateRequest($request);

    $idempleado = $request->idempleado;

    $fechainicio = $request->fecha_inicio;
    $fechafinal = $request->fecha_final;


    $fechainicio = Carbon::createFromFormat('d/m/Y',$fechainicio);
    $fechafinal = Carbon::createFromFormat('d/m/Y',$fechafinal);

    $fini = $fechainicio;
    $ffin = $fechafinal;

    $fechainicio = $fechainicio->toDateString();
    $fechafinal = $fechafinal->toDateString();


    if($fechafinal >= $fechainicio){
      $usuario = DB::table('ausencia as a')//select date_format(date, '%a %D %b %Y') 
      //DB::raw('DATE_FORMAT(account.terminationdate,"%Y-%m-%d") as accountterminationdate')
      ->join('vacadetalle as vd','a.idausencia','=','vd.idausencia')
      ->select(DB::raw('DATE_FORMAT(a.fechasolicitud,"%d/%m/%Y") as fechasolicitud'),(DB::raw('DATE_FORMAT(a.fechainicio,"%d/%m/%Y") as fechainicio')),(DB::raw('DATE_FORMAT(a.fechafin,"%d/%m/%Y") as fechafin')),'a.horainicio','a.horafin','a.totaldias','a.idempleado','a.totalhoras','vd.solhoras','vd.soldias','vd.periodo')
      ->where('a.fechainicio', '>=', $fechainicio, 'and', 'a.fechafin', '<=', $fechafinal, 'and','a.idempleado','=',$idempleado,'and','vd.estado','=','1')
      ->where('a.fechafin', '<=', $fechafinal)
      ->where('vd.estado','=',1)
      ->where('a.idempleado','=',$idempleado)
      ->where('vd.goce','!=','No_gozado')
      ->get();

      
      return response()->json(($usuario));
    }
    else{
      return response()->json(array('error'=>'la fecha inicio no puede ser mayor que la fecha final'),404);
    }
  }

  /*
  public function Gpdf($idempleado)
  {

    $usuario = DB::table('users as U')
    ->join('persona as per','U.identificacion','=','per.identificacion')
    ->join('empleado as emp','per.identificacion','=','emp.identificacion')
    ->join('nomytras as nom','emp.idempleado','=','nom.idempleado')
    ->join('puesto as pue','nom.idpuesto','=','pue.idpuesto')
    ->join('afiliado as afi','nom.idafiliado','=','afi.idafiliado')
    ->select('emp.idempleado','per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','pue.nombre as puesto','afi.nombre as afiliado')
    ->where('U.id','=',Auth::user()->id)
    ->orderBy('nom.idnomytas','desc')
    ->first();

    $today = Carbon::now();
    $year = $today->format('d/m/Y');



 
    $pdf= PDF::loadView('pdfs.gocevacaciones',["usuario"=>$usuario,"year"=>$year]);
    return $pdf->download('reporte.pdf');
    //return view('empleado.vacaciones.index',["ausencias"=>$ausencias,"searchText"=>$query,'usuarios'=>$usuarios,'ausencia'=>$ausencia,'vacaciones'=>$vacaciones]); 
    //return view ('reporte.gocevacaciones') ;
  }
*/

   public function Gpdf()
  {

    $usuario = DB::table('users as U')
    ->join('persona as per','U.identificacion','=','per.identificacion')
    ->join('empleado as emp','per.identificacion','=','emp.identificacion')
    ->join('nomytras as nom','emp.idempleado','=','nom.idempleado')
    ->join('puesto as pue','nom.idpuesto','=','pue.idpuesto')
    ->join('afiliado as afi','nom.idafiliado','=','afi.idafiliado')
    ->select('emp.idempleado','per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','pue.nombre as puesto','afi.nombre as afiliado')
    ->where('U.id','=',Auth::user()->id)
    ->orderBy('nom.idnomytas','desc')
    ->first();

    $today = Carbon::now();
    $year = $today->format('d/m/Y');



 
    $pdf= PDF::loadView('pdfs.gocevacaciones',["usuario"=>$usuario,"year"=>$year]);
    return $pdf->download('reporte.pdf');
    //return view('empleado.vacaciones.index',["ausencias"=>$ausencias,"searchText"=>$query,'usuarios'=>$usuarios,'ausencia'=>$ausencia,'vacaciones'=>$vacaciones]); 
    //return view ('reporte.gocevacaciones') ;
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

  public function validateRequest1($request){
        $rules=[

        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
  }
}