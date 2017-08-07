<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DateTime;
use DB;
use App\Empleado;
use Maatwebsite\Excel\Facades\Excel;
use App\Persona;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use App\Constants;
use App\Vacaciones;

class RHMintrab extends Controller
{
  public function __construct()
    {
        //$this->middleware('auth');
    }

    /*
    select sum(vd.acudias), sum(a.totaldias), sum(a.totalhoras), sum(vd.soldias), sum(vd.solhoras), vd.idempleado
    from vacadetalle as vd
    inner join ausencia as a on vd.idausencia = a.idausencia
    where vd.estado = 1 and a.idtipoausencia = 3
    group By vd.idempleado
    order by vd.idempleado;*/

    public function ttvacaciones()
    {
      $today = Carbon::now();
      $year = $today->format('Y');

      $inicioaño = $year.'-01-01';      // se concatena el año actual con un texto determinado para obtener el incio del año actual
      $finaño = $year.'-12-31';         // se concatena el año actual con un texto determinado para obtener el fin del año actual

      $vac = new Vacaciones();
      $vac = $vac->selectQuery(Constants::VACATOMADA_GENERAL_QUERY,array('fini'=>$inicioaño,'ffin'=>$finaño));


        $sum = 0;
        $res = 0;

        if(count($vac)>0)
        {
          for($i = 0; $i < count($vac); $i++)
          {
            $dsolicitado = $vac[$i]->totaldias;
            $hsolicitado = $vac[$i]->totalhoras;
            $dnotomado =   $vac[$i]->soldias;
            $hnotomado =   $vac[$i]->solhoras;

            $hsolicitado =(int)$hsolicitado; 
            $hnotomado = (int)$hnotomado;

            $tdsolicitado =0;
            $tdnotomado = 0;

            $td =0;
            $resul =0;
            
            $dsolicitado = $dsolicitado * 8;
            $dnotomado = $dnotomado *8;

            $tdsolicitado = $dsolicitado + $hsolicitado;
            $tdnotomado = $dnotomado + $hnotomado;

            $td = $tdsolicitado - $tdnotomado;
            $td = $td/8;
            $sum += $td;
          
            if ($td - floor($td) == 0) {
              $resul = $td." Días";
            }
            else{
              $td = $td - 0.5;
              $resul = $td." ½ "."Días";
            }

            $calculo[] = array($resul, $vac[$i]->idempleado);
          }

          if ($sum - floor($sum) == 0) {
            $res = $sum." Días";
          }
          else{
            $sum = $sum - 0.5;
            $res = $sum." ½ "."Días";
          }
        }
        else{
          $calculo[] = 0;
        }
      
    }
}
