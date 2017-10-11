<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;

class JIViajeController extends Controller
{
    public function index()
    {
    	return view ('director.viaje.index');
    }
    public function solicitados()
    {
        $usuario = DB::table('users as u')
        ->join('persona as p','u.identificacion','=','p.identificacion')
        ->join('asignajefe as jf','p.identificacion','=','jf.identificacion')
        ->select('jf.identificacion')
        ->where('u.id','=',Auth::user()->id)
        ->first();

        $viaje = DB::table('empleado as emp')
        ->join('asignajefe as aj','aj.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('gastoencabezado as ge','emp.idempleado','=','ge.idempleado')
        ->join('tipogasto as tg','ge.idtipogasto','=','tg.idtipogasto')
        ->join('proyectocabeza as pc','pc.idproyecto','=','ge.idproyecto')
        ->join('gastoviaje as gv','gv.idgastocabeza','=','ge.idgastocabeza')
        ->join('viaje as v','v.idviaje','=','gv.idviaje')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','emp.idempleado','tg.tipogasto','ge.montosolicitado','pc.nombreproyecto','v.fechainicio','v.fechafin')
        ->where('aj.identificacion','=',$usuario->identificacion)
        ->where('pc.status','=','Solicitado')       
        ->paginate(15);  

    	return view ('director.viaje.indexsol',['viaje'=>$viaje]);
    }
    public function autorizados()
    {
        $usuario = DB::table('users as u')
        ->join('persona as p','u.identificacion','=','p.identificacion')
        ->join('asignajefe as jf','p.identificacion','=','jf.identificacion')
        ->select('jf.identificacion')
        ->where('u.id','=',Auth::user()->id)
        ->first();

        $viaje = DB::table('empleado as emp')
        ->join('asignajefe as aj','aj.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('gastoencabezado as ge','emp.idempleado','=','ge.idempleado')
        ->join('tipogasto as tg','ge.idtipogasto','=','tg.idtipogasto')
        ->join('proyectocabeza as pc','pc.idproyecto','=','ge.idproyecto')
        ->join('gastoviaje as gv','gv.idgastocabeza','=','ge.idgastocabeza')
        ->join('viaje as v','v.idviaje','=','gv.idviaje')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','emp.idempleado','tg.tipogasto','ge.montosolicitado','pc.nombreproyecto','v.fechainicio','v.fechafin')
        ->where('aj.identificacion','=',$usuario->identificacion)
        ->where('pc.status','=','Solicitado')       
        ->paginate(15);

    	return view ('director.viaje.indexauto',['viaje'=>$viaje]);
    }
    public function detallesol($id)
    {
        $viaje = DB::table('empleado as emp')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('gastoencabezado as ge','emp.idempleado','=','ge.idempleado')
        ->join('tipogasto as tg','ge.idtipogasto','=','tg.idtipogasto')
        ->join('proyectocabeza as pc','pc.idproyecto','=','ge.idproyecto')
        ->join('gastoviaje as gv','gv.idgastocabeza','=','ge.idgastocabeza')
        ->join('viaje as v','v.idviaje','=','gv.idviaje')
        ->join('viajevehiculo as vv','vv.idviaje','=','v.idviaje')
        ->join('vehiculo as vhc','vhc.idviajevehiculo','=','vv.idviajevehiculo')
        ->join('vstatus as vs','vs.idvstatus','=','vhc.idvstatus')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','tg.tipogasto','ge.montosolicitado','pc.nombreproyecto','v.fechainicio','v.fechafin','ge.chequetransfe','ge.moneda','v.motivo','v.numerodias','vhc.placa','vhc.marca','vhc.color','vhc.kilacumulado')
        ->where('emp.idempleado','=',$id)
        ->where('pc.status','=','Solicitado')       
        ->paginate(15);
        //return view('director.viaje.detallesol',['detalle'=>$detalle])
    }
    public function detalleauto()
    {
    	return view ('director.viaje.detalles');
    }
}