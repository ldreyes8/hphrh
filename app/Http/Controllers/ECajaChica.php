<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Auth;
use App\GastoEncabezado;
use App\GastoViajeEmpleado;
use App\Viaje;
use App\ViajeVehiculo;
use App\GastoViaje;
use App\Vehiculo;
use App\Persona;
use App\Constants;
use Illuminate\Support\Collection as Collection;

class ECajaChica extends Controller
{
     public function add(){
        $proyectos = DB::table('proyectocabeza as pca')
        ->select('pca.idproyecto','pca.nombreproyecto as proyecto')
        ->get();

        $vehiculos = DB::table('vehiculo as veh')
        ->join('vstatus as vst','veh.idvstatus','=','vst.idvstatus')
        ->select('veh.color','veh.marca','veh.modelo','veh.idvehiculo')
        ->where('veh.idvstatus','=',1)
        ->get();

        $eles = DB::table('codigointerno as cin')
        ->join('codigoraiz as cra','cin.idele','=','cra.idele')
        ->select('cin.codigo','cin.nombre','cra.codigo as L','cra.nombre as craiz')
        ->get();

        return view ('empleado.cajachica.create',["eles"=>$eles,"proyectos"=>$proyectos,"vehiculos"=>$vehiculos]);
    }
}
