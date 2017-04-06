<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
     public function index (Request $request)
    {
    	if ($request)
    	{
    	}

    	return view('empleado.perfil.index');
    }

}
