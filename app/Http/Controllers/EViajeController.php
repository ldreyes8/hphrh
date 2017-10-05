<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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

    	//return $add->fetchAll(PDO::FETCH_ASSOC);
    	//return json_encode($add);
    	return json_decode($add);
    }
}
