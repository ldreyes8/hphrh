<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Storage;
use DB;
use Carbon\Carbon; //para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Rechazados extends Controller
{
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
        ->join('status as st','e.idstatus','=','st.idstatus')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('afiliado as af','p.idafiliado','=','af.idafiliado')
        ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
        ->select('e.idempleado','e.identificacion','e.nit','p.nombre1 as nombre','p.apellido1 as apellido','af.nombre as fnombre','pu.nombre as pnombre','st.statusemp as statusn')
        ->where('e.idstatus','=',8)
        ->where('p.nombre1','LIKE','%'.$query.'%')
        ->orderBy('e.idempleado','desc')
        //->orderBy('e.idempleado','desc')
         ->paginate(19);
         /*

        $query=trim($request->get('searchText'));
        $empleado=DB::table('empleado as e')
        ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
        ->join('status as st','e.idstatus','=','st.idstatus')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('nomytras as nt','e.idempleado','=','nt.idempleado')
        ->join('puesto as po','nt.idpuesto','=','po.idpuesto')
        ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
        ->select('e.idempleado','e.identificacion','e.nit','p.nombre1 as nombre','p.apellido1 as apellido','st.statusemp as statusn','po.nombre as npo','af.nombre as naf')
        ->where('e.idstatus','=',2)
        ->where('p.nombre1','LIKE','%'.$query.'%')
        ->orderBy('e.idempleado','asc')
        //->orderBy('e.idempleado','desc')
         ->paginate(19);*/
        }

        return view('listados.rechazados.index',["empleado"=>$empleado,"searchText"=>$query]);
    }
    public function show ($id)
    {
        $empleado=DB::table('empleado as e')
        ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
        ->select('e.identificacion','e.numerodependientes','e.nit')
        ->where('e.identificacion','=',$id)
        ->first();
        return view('listados.empleado.show',["empleado"=>$empleado]);
    }
}
