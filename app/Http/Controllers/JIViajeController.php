<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JIViajeController extends Controller
{
    public function index()
    {
    	return view ('director.viaje.index');
    }
    public function solicitados()
    {
    	return view ('director.viaje.indexsol');
    }
    public function autorizados()
    {
    	return view ('director.viaje.indexauto');
    }
    public function detalleauto()
    {
    	return view ('director.viaje.detalles');
    }
}
