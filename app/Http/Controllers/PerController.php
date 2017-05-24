<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PerController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
     public function index (Request $request)
    {
    	
     
        //dd($usuario);
 

        //return view("hr.referencias",["referencia"=>$referencia,"empleado"=>$empleado]); 

    	return view('empleado.perfil.index');
    }

}
