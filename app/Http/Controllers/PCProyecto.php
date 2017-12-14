<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Response;
use Validator;
use Carbon\Carbon;  // para poder usar la fecha y hora

use App\Proyecto;
use App\Http\Requests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PCProyecto extends Controller
{
    public function index(Request $request)
    {
    	$proyectos = DB::table('proyecto as pca')
    		->select('pca.idproyecto','pca.nombreproyecto as proyecto','pca.montoproyecto as monto','pca.descripcion','pca.status','pca.saldoproyecto as saldo','pca.indice')
    		->get();

        return view('seguridad.proyecto.index',["proyectos"=>$proyectos]);
    }

    public function store(Request $request)
    {
    	$this->validateRequestViaje($request);
    	try 
        {
            DB::beginTransaction();

            //Gasto viaje empleado

           	if($request->default == 1)
           	{
           		$determinado = DB::table('proyecto as pro')
           		->select('pro.idproyecto')
           		->where('pro.indice','=','1')
           		->first();

           		$proyecto = Proyecto::find($determinado->idproyecto);
           		$proyecto->indice = 0;
           		$proyecto->save();
           	}

            $fechainicio = $request->fecha_inicio; 
	      	$fechafinal = $request->fecha_final;

	      	$fechainicio = Carbon::createFromFormat('d/m/Y',$fechainicio);
	      	$fechafinal = Carbon::createFromFormat('d/m/Y',$fechafinal);

	      	$fechainicio = $fechainicio->toDateString();
	      	$fechafinal = $fechafinal->toDateString();

            $proyecto = new Proyecto;
            $proyecto->nombreproyecto   = $request->proyecto;
            $proyecto->montoproyecto      = $request->monto;
            $proyecto->descripcion = $request->descripcion;
            $proyecto->fechainicio = $fechainicio;
            $proyecto->fechafin  = $fechafinal;
            $proyecto->status = "activo";
            $proyecto->saldoproyecto   = $request->monto;
            $proyecto->codigoconta = $request->codigo_conta;
            $proyecto->indice =$request->default;
            $proyecto->save();

            DB::commit();
        }catch (\Exception $e) 
        {
          DB::rollback();
          return response()->json(array('error' => 'No se ha podido enviar la solicitud'),404);         
        }
        return response()->json($proyecto);
    }

    // dejar como predeterminado un proyecto existente.
    public function default(Request $request)
    {
    	try 
        {
            DB::beginTransaction();
	    	$determinado = DB::table('proyecto as pro')
	           		->select('pro.idproyecto')
	           		->where('pro.indice','=','1')
	           		->first();
			
			$proyecto = Proyecto::find($determinado->idproyecto);
	        $proyecto->indice = 0;
	        $proyecto->save();

	        //El proyecto que ahora es el predeterminado.

	        $proyecto = Proyecto::find($request->proyecto);
	        $proyecto->indice = 1;
	        $proyecto->save();

            DB::commit();
        }catch (\Exception $e) 
        {
          DB::rollback();
          return response()->json(array('error' => 'No se ha podido modificar el proyecto'),404);         
        }
        return response()->json($proyecto);

    }

    public function validateRequestViaje($request){
        $rules=[
            'proyecto' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
            'monto' => 'required',
            'codigo_conta' => 'required',
            'descripcion' => 'required',
        ];
        $messages=[
            'required' => 'Debe ingresar :attribute.',
            'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }
}