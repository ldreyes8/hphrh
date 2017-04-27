<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Storage;
use DB;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ListadoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index (Request $request)
    {
    	if ($request)
    	{
        $query=trim($request->get('searchText'));
    	$empleado=DB::table('empleado as e')
        ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
        ->join('status as st','e.idstatus','=','st.idstatus')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->select('e.idempleado','e.identificacion','e.nit','e.afiliacionigss','e.numerodependientes','e.aportemensual','e.vivienda','e.alquilermensual','e.otrosingresos','ec.estado as estadocivil','p.nombre1 as nombre','p.apellido1 as apellido','st.statusemp as statusn')
        ->where('e.idstatus','=',2)
        ->where('p.nombre1','LIKE','%'.$query.'%')
		->orderBy('e.idempleado','asc')
		//->orderBy('e.idempleado','desc')
         ->paginate(19);
    	}

    	return view('listados.index',["empleado"=>$empleado,"searchText"=>$query]);
    }
    public function show (Request $request)
    {
    	
    }
}
