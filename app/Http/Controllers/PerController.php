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
        $empleado2=DB::table('empleado as e')
            ->join('persona as p','p.identificacion','=','e.identificacion')
            ->join('users as urs','urs.identificacion','=','p.identificacion')
            ->select('e.observacion')
            ->where('urs.id','=',Auth::user()->id)
            ->first();
    	return view('empleado.perfil.index',["empleado2"=>$empleado2]);
    }

    public function contacto(Request $request)
    {
        return view('empleado.perfil.contacto');
    }

    public function solicitud(Request $request)
    {
        return view('empleado.solicitud.index');
    }
}
