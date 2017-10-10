<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class EViajeController extends Controller
{
	public function index(){
    	return view ('empleado.viaje.index');
    }

    public function viaje(){
    	
    	return view ('empleado.viaje.indexviaje');
    }

    public function liquidar(){
    	$liquidaciones = DB::table('tableedit as tab')
    	->select('tab.id','tab.fecha','tab.empleado','tab.factura')
    	->get();

    	return view ('empleado.viaje.indexliquidar',["liquidaciones"=>$liquidaciones]);
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
