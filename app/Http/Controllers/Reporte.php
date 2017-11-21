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
use App\Empleado;
use App\Constants;
class Reporte extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
    	
        $nomytras = new Empleado();
        $nomytras = $nomytras->selectQuery(Constants::FI_reporte,array());


    	return view('reporte.empleadosalario',["nomytras"=>$nomytras]);
    }

    public function Empleadoexcel()
    {
        $nomytras = new Empleado();
        $nomytras = $nomytras->selectQuery(Constants::FI_reporte,array());
        
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
