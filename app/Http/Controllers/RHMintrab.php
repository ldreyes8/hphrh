<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DateTime;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Persona;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;

class RHMintrab extends Controller
{
    /*
    select sum(vd.acudias), sum(a.totaldias), sum(a.totalhoras), sum(vd.soldias), sum(vd.solhoras), vd.idempleado
from vacadetalle as vd
inner join ausencia as a on vd.idausencia = a.idausencia
where vd.estado = 1 and a.idtipoausencia = 3
group By vd.idempleado
order by vd.idempleado;*/

	$today = Carbon::now();
    $year = $today->format('Y');

    $iniaño = '01-01-'.$year;  
    $finaño = '31-12-'.$year;


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
