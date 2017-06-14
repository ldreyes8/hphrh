<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eventos;
use App\Persona;
use DB;


use Carbon\Carbon;  // para poder usar la fecha y hora


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
        $today = Carbon::now();
        $year = $today->format('Y');
        $month = $today->format('m');
        $day = $today->format('d');
   
        $persona = DB::table('persona as per')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('per.nombre1', 'per.apellido1','U.fotoperfil')
        ->whereMonth('per.fechanac','=',$month)
        ->get();

        $cumpledia = DB::table('persona as per')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('per.nombre1', 'per.apellido1','U.fotoperfil')
        ->whereDay('per.fechanac','=',$day)
        ->whereMonth('per.fechanac','=',$month)
        ->get();

        $usuarioactual=\Auth::user();
        $tablero = Eventos::all();
        return view('home',array('tablero'=>$tablero,'persona'=>$persona,'cumpledia'=>$cumpledia));
    }
}
