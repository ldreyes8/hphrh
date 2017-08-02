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

      //$idempleado = $request->idempleado;

      $historialvacaciones =DB::table('ausencia as a')
          ->join('empleado as emp','a.idempleado','=','emp.idempleado')
          ->join('persona as per','emp.identificacion','=','per.identificacion') 
          ->join('tipoausencia as ta','a.idtipoausencia','=','ta.idtipoausencia')
          ->join('vacadetalle as vd','a.idausencia','=','vd.idausencia')
          ->select('vd.idempleado')
          ->where('ta.ausencia','=','Vacaciones')
          ->where('a.autorizacion','=','Confirmado')
          ->where('a.fechasolicitud', '>=', $inicioaño)
          ->where('a.fechasolicitud', '<=', $finaño)
          ->groupBy('a.idempleado')
          ->orderBy('a.idempleado','desc')
          ->get();


          $historialvacaciones = array("175","176","841");

      $totalempleados = DB::table('empleado as emp')
            ->join('nomytras as nt','emp.idempleado','=','nt.idempleado')
            ->join('status as st','emp.idstatus','=','st.idstatus')
            ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
            ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
            ->join('caso as c','c.idcaso','=','nt.idcaso')
            ->select('emp.idempleado')
            ->where('emp.idstatus','=', 2)
            ->groupBy('emp.idempleado')      
            ->orderBy('emp.idempleado','desc')
            ->get();

      $totalemp = array();


      foreach ($totalempleados as $valor) {
        if(in_array($valor, $historialvacaciones))
        {
          $totalemp[] = array("mensaje");
        }
        else
        {
          $totalemp[] = "*.*";
        }
      }


         
          print_r($totalemp);
    }
}
