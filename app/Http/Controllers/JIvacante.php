<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Afiliado;
use App\Puesto;

use Validator;
use App\Vacante;
use App\Bitacoravacante;

use Carbon\Carbon;  // para poder usar la fecha y hora
use Illuminate\Support\Facades\Auth; 
use DB;
use Illuminate\Support\Collection as Collection;


class JIvacante extends Controller
{
    public function add()
    {

    	$empleado = DB::table('persona as per')
    	->join('users as U','per.identificacion','=','U.identificacion')
    	->select('per.identificacion')
    	->where('U.id','=',Auth::user()->id)
    	->first();
    	
    	$puesto = Puesto::all();

    	$afiliado = DB::select("call solicitarpuesto(?)",array($empleado->identificacion));
    	return view('director.vacante.solicitarpuesto',array('afiliado'=>$afiliado,'puesto'=>$puesto));
    }

    public function store(Request $request){
    	try {
    		DB::beginTransaction();

    			$mytime = Carbon::now('America/Guatemala');

	    		$empleado = DB::table('persona as per')
	    		->join('users as U','per.identificacion','=','U.identificacion')
	    		->select('per.identificacion')
	    		->where('U.id','=',Auth::user()->id)
	    		->first();

	    		$vacante = new Vacante();
	    		$vacante->idpuesto = $request->idpuesto;
	    		$vacante->idafiliado = $request->idafiliado;
	    		$vacante->fecha = $mytime->toDateString();
	    		$vacante->idusuario = Auth::user()->id;
	    		$vacante->status = 'Solicitado';

	    		$vacante->save();

	    		$bitacora = new Bitacoravacante();
	    		$bitacora->idpuesto = $request->idpuesto;
	    		$bitacora->idafiliado = $request->idafiliado;
	    		$bitacora->status = 'Solicitado';
	    		$bitacora->idpersona = $empleado->identificacion;
	    		$bitacora->fechasol = $mytime;

	    		$bitacora->save();
    		DB::commit();

    	}catch (\Exception $e) 
    	{
    	    DB::rollback();
    	    return response()->json(array('error' => 'No se ha podido enviar la solicitud'),404);         
    	}
    	return response()->json($vacante);
    }
}
