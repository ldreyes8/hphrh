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
use App\Asignajefe;
use App\Http\Requests\Nomrequest;


class Pprueba extends Controller
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
            ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
            ->join('status as st','e.idstatus','=','st.idstatus')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('nomytras as nt','e.idempleado','=','nt.idempleado')
            ->join('puesto as po','nt.idpuesto','=','po.idpuesto')
            ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
            ->select('e.idempleado','e.identificacion','e.nit','p.nombre1 as nombre','p.apellido1 as apellido','st.statusemp as statusn','po.nombre as npo','af.nombre as naf','nt.salario as sal')
            ->where('e.idstatus','=',9)
            ->where('p.nombre1','LIKE','%'.$query.'%')
            ->orderBy('e.idempleado','asc')
            //->orderBy('e.idempleado','desc')
            ->paginate(19);
        }
        return view('listados.pprueba.index',["empleado"=>$empleado,"searchText"=>$query]);
    }
    public function show ($id)
    {/*
        $empleado=DB::table('empleado as e')
        ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
        ->select('e.identificacion','e.numerodependientes','e.nit')
        ->where('e.identificacion','=',$id)
        ->first();
        return view('listados.empleado.show',["empleado"=>$empleado]);*/
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

        /*$jefesinmediato=DB::table('jefesinmediato as ji')
        ->join('persona as per','ji.identificacion','=','per.identificacion')
        ->select('ji.idjefeinmediato','per.nombre1','per.apellido1')
        ->get();*/

        $jefesinmediato=DB::table('persona as per')
        ->join('empleado as em','per.identificacion','=','em.identificacion')
        ->join('status as sts','em.idstatus','=','sts.idstatus')
        ->select('per.identificacion','per.nombre1','per.nombre2','per.apellido1','per.apellido2')
        ->where('em.idstatus','=',2)
        ->get();

        $caso=DB::table('caso as c')
        ->select('c.idcaso','c.nombre')
        ->get();

        return view("listados.pprueba.create",["puestos"=>$puestos,"afiliados"=>$afiliados,"caso"=>$caso,"empleado"=>$empleado,"jefesinmediato"=>$jefesinmediato]);
    }

    public function store(Nomrequest $request)
    {
        try 
        {
            $idem = $request->get('idempleado');
            $idco = $request->get('idcaso');
            //$idji = $request->get('idjefe');
            $today = Carbon::now();
            $year = $today->format('Y');
            
            if ($idco=="4")
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

                $identi=$request->get('idjefes');
                $notifica=$request->get('confirma');

                $cont = 0;

                if ($notifica === Null) 
                {
                    $asjefe =new Asignajefe;
                    $asjefe-> identificacion="";
                } 
                else 
                {
                    while ($cont<count($notifica)) 
                    {
                        $asjefe = new Asignajefe;
                        $asjefe-> identificacion=$identi[$cont];
                        $asjefe-> idempleado=$idem;
                        $asjefe-> notifica=$notifica[$cont];
                        $asjefe->save();
                        $cont = $cont + 1;
                    }
                }

                $vacas=new Vacadetalle;
                $vacas-> idempleado=$idem;
                $vacas-> periodo=$year;
                $vacas-> acuhoras='0';
                $vacas-> acudias='0';
                $vacas-> solhoras='0';
                $vacas-> fecharegistro=$fecha;
                $vacas-> soldias='0';
                $vacas->save();

                $st=Empleado::find($idem);
                $st-> fechaingreso=$fecha;
                //$st-> idjefeinmediato=$idji;
                $st-> idstatus='9';
                $st-> update();
            }
            if ($idco=="6")
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

                $identi=$request->get('idjefes');
                $notifica=$request->get('confirma');

                $cont = 0;

                if ($notifica === Null) 
                {
                    $asjefe =new Asignajefe;
                    $asjefe-> identificacion="";
                } 
                else 
                {
                    while ($cont<count($notifica)) 
                    {
                        $asjefe = new Asignajefe;
                        $asjefe-> identificacion=$identi[$cont];
                        $asjefe-> idempleado=$idem;
                        $asjefe-> notifica=$notifica[$cont];
                        $asjefe->save();
                        $cont = $cont + 1;
                    }
                }

                $vacas=new Vacadetalle;
                $vacas-> idempleado=$idem;
                $vacas-> periodo=$year;
                $vacas-> acuhoras='0';
                $vacas-> acudias='0';
                $vacas-> solhoras='0';
                $vacas-> fecharegistro=$fecha;
                $vacas-> soldias='0';
                $vacas->save();

                $st=Empleado::find($idem);
                $st-> fechaingreso=$fecha;
                //$st-> idjefeinmediato=$idji;
                $st-> idstatus='2';
                $st-> update();
            }

            if ($idco=="7") 
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

                $identi=$request->get('idjefes');
                $notifica=$request->get('confirma');

                $cont = 0;

                if ($notifica === Null) 
                {
                    $asjefe =new Asignajefe;
                    $asjefe-> identificacion="";
                } 
                else 
                {
                    while ($cont<count($notifica)) 
                    {
                        $asjefe = new Asignajefe;
                        $asjefe-> identificacion=$identi[$cont];
                        $asjefe-> idempleado=$idem;
                        $asjefe-> notifica=$notifica[$cont];
                        $asjefe->save();
                        $cont = $cont + 1;
                    }
                }

                $st=Empleado::find($idem);
                $st-> fechaingreso=$fecha;
                //$st-> idjefeinmediato=$idji;
                $st-> idstatus='11';
                $st-> update();
            }

        } catch (Exception $e) 
        {}
        return Redirect::to('empleado/solicitante');    }

}