<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eventos;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioactual=\Auth::user();
        $tablero = Eventos::all();
         //return view("home",["usuario"=>$usuarioactual,"tablero"=>$tablero,"caso"=>$caso,"empleado"=>$empleado]);
        return view('home',array('tablero'=>$tablero));
    }
}
