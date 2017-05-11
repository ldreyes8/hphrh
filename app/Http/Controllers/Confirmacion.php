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

use App\Empleado;
use App\Nomytras;
use App\Vacadetalle;
use App\Http\Requests\Nomrequest;

class Confirmacion extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update($id)
    {
        $puestos=DB::table('puesto as p')
        ->join('persona as per','p.idpuesto','=','per.idpuesto')
        ->join('empleado as em','per.identificacion','=','em.identificacion')
        ->select('p.idpuesto','p.nombre')
        ->where('em.idempleado','=',$id)
        ->first();

        $empleado=DB::table('empleado as e')
        ->join('persona as ec','e.identificacion','=','ec.identificacion')
        ->select('e.idempleado','ec.nombre1','ec.apellido1')
        ->where('e.idempleado','=',$id)
        ->first();

        $afiliados=DB::table('afiliado as a')
        ->join('persona as per','a.idafiliado','=','per.idafiliado')
        ->join('empleado as em','per.identificacion','=','em.identificacion')
        ->select('a.idafiliado','a.nombre')
        ->where('em.idempleado','=',$id)
        ->first();

        $jefesinmediato=DB::table('jefesinmediato as ji')
        ->join('persona as per','ji.identificacion','=','per.identificacion')
        ->select('ji.idjefeinmediato','per.nombre1','per.apellido1')
        ->get();

        $caso=DB::table('caso as c')
        ->select('c.idcaso','c.nombre')
        ->where('c.idcaso','=',2)
        ->get();

        return view("listados.confirmacion.create",["puestos"=>$puestos,"afiliados"=>$afiliados,"caso"=>$caso,"empleado"=>$empleado,"jefesinmediato"=>$jefesinmediato]);
        //return Redirect::to('listados/pprueba/create');
    }

    public function store(Nomrequest $request)
    {
        try 
        {
            $idem = $request->get('idempleado');
            $idco = $request->get('idcaso');
            $idji = $request->get('idjefe');
            $today = Carbon::now();
            $year = $today->format('Y');

            if ($idco=="2")
            {
                //dd($idem,$idco);
                $fecha=$request->get('fecha');
                $fecha=Carbon::createFromFormat('d/m/Y',$fecha);
                $fecha=$fecha->format('Y-m-d');

                $nomtras=new Nomytras;
                $nomtras-> idpuesto=$request->get('idpuesto');
                $nomtras-> idempleado=$idem;
                $nomtras-> fecha=$fecha;
                $nomtras-> salario=$request->get('salario');
                $nomtras-> descripcion=$request->get('descripcion');
                $nomtras-> idafiliado=$request->get('idafiliado');
                $nomtras-> idcaso=$idco;
                $nomtras->save();

                $st=Empleado::find($idem);
                $st-> fechaingreso=$fecha;
                $st-> idjefeinmediato=$idji;
                $st-> idstatus='2';
                $st-> update();
            }

        } catch (Exception $e) 
        {}
        return Redirect::to('listados/pprueba');
    }
}
