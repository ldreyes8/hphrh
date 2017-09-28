<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JIViajeController extends Controller
{
    public function index()
    {
    	return view ('director.viaje.index');
    }
    public function solicitado()
    {
    	return view ('director.viaje.indexsol');
    }
}
