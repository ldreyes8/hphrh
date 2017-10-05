<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DateTime;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Persona;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use App\Nomytras;
use Illuminate\Support\Collection;

class Reporte extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
    	$nomytras = DB::table('nomytras as nt')
    	->join('afiliado as a','nt.idafiliado','=','a.idafiliado')
    	->join('puesto as p','nt.idpuesto','=','p.idpuesto')
    	->join('empleado as emp','nt.idempleado','=','emp.idempleado')
    	->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('caso as ca','nt.idcaso','=','ca.idcaso')
        ->join('users as U','per.identificacion','=','U.identificacion')
    	->select('a.nombre as afiliado','p.nombre as puesto','per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','nt.salario','per.identificacion','emp.fechaingreso as fecha','ca.nombre as caso','U.email','per.correo')
        ->where('emp.idstatus','=',2)
    	->groupBy('emp.idempleado')
    	->orderBy('a.nombre','asc')
        ->orderBy('p.nombre','asc')
        ->orderBy('per.apellido1')
    	->get();
        

    	return view('reporte.empleadosalario',["nomytras"=>$nomytras]);
    	//$usuarioactual=\Auth::user();
        //$afiliados = Afiliado::all();
        //$usuarios= User::Busqueda($afiliado,$dato)->paginate(25);  
        //$afiliadosel = $afiliados->find($afiliado);

        //return view('hr.galeria')
        //->with("afiliadosel",$afiliadosel)
        //->with("afiliados",$afiliados)
        //->with("usuarios", $usuarios )
        //->with("usuario_actual", $usuarioactual); 	
    }

    public function Empleadoexcel()
    {
        $nomytras = DB::table('nomytras as nt')
    	->join('afiliado as a','nt.idafiliado','=','a.idafiliado')
    	->join('puesto as p','nt.idpuesto','=','p.idpuesto')
    	->join('empleado as emp','nt.idempleado','=','emp.idempleado')
    	->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('caso as ca','nt.idcaso','=','ca.idcaso')
        ->join('users as U','per.identificacion','=','U.identificacion')
    	->select('a.nombre as afiliado','p.nombre as puesto','per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','nt.salario','per.identificacion','emp.fechaingreso as fecha','emp.idempleado','ca.nombre as caso','ca.nombre as caso','U.email','per.correo')
    	->where('emp.idstatus','=',2)
        ->groupBy('emp.idempleado')
    	->orderBy('a.nombre','asc')
        ->orderBy('p.nombre','asc')
        ->orderBy('per.apellido1')
        ->get();

        Excel::create("Reporte Empleado", function ($excel) use ($nomytras)  
            {
                $excel->sheet("Reporte", function ($sheet) use ($nomytras)
                {
                    $sheet->loadView('Excel.reporteempleado',['nomytras'=>$nomytras]);
                });
            })->download('xls');
        return back();
    }
}
