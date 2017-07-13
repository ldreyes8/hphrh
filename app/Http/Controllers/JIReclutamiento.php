<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JIReclutamiento extends Controller
{
     public function index (Request $request)
    {
    	    
        //dd($usuario);
        //return view("hr.referencias",["referencia"=>$referencia,"empleado"=>$empleado]); 
    	return view('empleado.reclutamiento.index');
    }
}
