<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EViajeController extends Controller
{
	public function index(){
    	return view ('empleado.viaje.index');
    }

    public function viaje(){
    	return view ('empleado.viaje.indexviaje');
    }

    public function liquidar(){
    	return view ('empleado.viaje.indexliquidar');
    }
}
