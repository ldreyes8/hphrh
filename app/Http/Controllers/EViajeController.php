<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class EViajeController extends Controller
{   
    // metodos del viaje
	public function index(){
    	return view ('empleado.viaje.index');
    }

    public function viaje(){
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

    	return view ('empleado.viaje.indexviaje',["eles"=>$eles,"proyectos"=>$proyectos,"vehiculos"=>$vehiculos]);
    }

    // metodos de una nueva liquidación
    public function liquidar(){
    	$liquidaciones = DB::table('tableedit as tab')
    	->select('tab.id','tab.fecha','tab.empleado','tab.factura')
    	->get();

    	return view ('empleado.viaje.indexliquidar',["liquidaciones"=>$liquidaciones]);
    }

    public function addv(){
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

        return view ('empleado.viaje.create',["eles"=>$eles,"proyectos"=>$proyectos,"vehiculos"=>$vehiculos]);
    }
    
    public function add(){
    	$add = DB::table('L10')
    	->select('L10.codigo','L10.nombre')
    	->get();

        $afiliado = DB::table('afiliado as afi')
        ->join('persona as per','afi.idafiliado','=','per.idafiliado')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('afi.idafiliado')
        ->where('U.id','=',Auth::user()->id)
        ->first();

        $empleado = DB::table('persona as per')
        ->join('empleado as emp','per.identificacion','=','emp.identificacion')
        ->where('per.idafiliado','=',$afiliado->idafiliado)
        ->where('emp.idstatus','=',2)
        ->select('per.nombre1','per.nombre2','per.apellido1','per.apellido2','emp.idempleado')
        ->get();

        return view('empleado.viaje.row',["add"=>$add,"empleado"=>$empleado]);
    	//return $add->fetchAll(PDO::FETCH_ASSOC);
    	//return json_encode($add);
//    	return json_decode($add);
    }
}
