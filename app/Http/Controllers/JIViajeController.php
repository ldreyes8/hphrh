<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use App\Vehiculo;
use App\GastoCabeza;
use Validator;
use ViajeV;

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

        /*$asistente =DB::select("call pcasistentes(?)",array(Auth::user()->id));
        dd($asistente);*/

        $viaje = DB::table('empleado as emp')
        ->join('asignajefe as aj','aj.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('gastoencabezado as ge','emp.idempleado','=','ge.idempleado')
        ->join('tipogasto as tg','ge.idtipogasto','=','tg.idtipogasto')
        ->join('proyectocabeza as pc','pc.idproyecto','=','ge.idproyecto')
        ->join('gastoviaje as gv','gv.idgastocabeza','=','ge.idgastocabeza')
        ->join('viaje as v','v.idviaje','=','gv.idviaje')
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','emp.idempleado','tg.tipogasto','ge.idgastocabeza','ge.montosolicitado','pc.nombreproyecto','v.fechainicio','v.fechafin')
        ->where('aj.identificacion','=',$usuario->identificacion)
        ->where('ge.statusgasto','=','solicitado')       
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
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','emp.idempleado','tg.tipogasto','ge.idgastocabeza','ge.montosolicitado','pc.nombreproyecto','v.fechainicio','v.fechafin')
        ->where('aj.identificacion','=',$usuario->identificacion)
        ->where('ge.statusgasto','=','Autorizado')       
        ->paginate(15);  

    	return view ('director.viaje.indexauto',['viaje'=>$viaje]);
    }
    public function detallesolicitud($id)
    {
        $viaje = DB::table('empleado as emp')
        ->join('gastoencabezado as ge','emp.idempleado','=','ge.idempleado')
        ->join('tipogasto as tg','ge.idtipogasto','=','tg.idtipogasto')
        ->join('proyectocabeza as pc','pc.idproyecto','=','ge.idproyecto')
        ->join('gastoviaje as gv','gv.idgastocabeza','=','ge.idgastocabeza')
        ->join('viaje as v','v.idviaje','=','gv.idviaje')
        ->select('emp.idempleado','tg.tipogasto','ge.montosolicitado','pc.nombreproyecto','v.fechainicio','v.fechafin','ge.chequetransfe','ge.moneda','v.motivo','v.numerodias')
        ->where('ge.idgastocabeza','=',$id)
        ->where('ge.statusgasto','=','solicitado')       
        ->get();

        $empleado = DB::table('empleado as e')
        ->join('persona as p','p.identificacion','=','e.identificacion')
        ->join('users as u','u.identificacion','=','p.identificacion')
        ->join('gastoencabezado as ge','e.idempleado','=','ge.idempleado')
        ->select(DB::raw('CONCAT(p.nombre1," ",p.nombre2," ",p.apellido1," ",p.apellido2) AS nombre'),'e.idempleado','ge.idgastocabeza','u.email')
        ->where('ge.idgastocabeza','=',$id)
        ->first();

        $vehiculo = DB::table('gastoencabezado as ge')
        ->join('gastoviaje as gv','gv.idgastocabeza','=','ge.idgastocabeza')
        ->join('viaje as v','v.idviaje','=','gv.idviaje')
        ->join('viajevehiculo as vv','vv.idviaje','=','v.idviaje')
        ->join('vehiculo as vhc','vhc.idvehiculo','=','vv.idvehiculo')
        ->join('vstatus as vs','vs.idvstatus','=','vhc.idvstatus')
        ->select('vv.idviajevehiculo','vhc.idvehiculo','vhc.placa','vhc.marca','vhc.color','vhc.kilacumulado','vs.statusvehiculo')
        ->where('ge.idgastocabeza','=',$id)
        ->get();

        $asistente =DB::select("call pcasistentes(?)",array(Auth::user()->id));

        return view('director.viaje.dsolicitud',['viaje'=>$viaje,'empleado'=>$empleado,'vehiculo'=>$vehiculo,'asistente'=>$asistente]);
    }
    public function detalleauto($id)
    {
        $empleado = DB::table('empleado as e')
        ->join('persona as p','p.identificacion','=','e.identificacion')
        ->join('users as u','u.identificacion','=','p.identificacion')
        ->join('gastoencabezado as ge','e.idempleado','=','ge.idempleado')
        ->join('tipogasto as tg','tg.idtipogasto','=','ge.idtipogasto')
        ->select(DB::raw('CONCAT(p.nombre1," ",p.nombre2," ",p.apellido1," ",p.apellido2) AS nombre'),'e.idempleado','ge.idgastocabeza','u.email','tg.tipogasto')
        ->where('ge.idgastocabeza','=',$id)
        ->first();

        $liquida = DB::table('gastoencabezado as ge')
        ->join('tipogasto as tg','ge.idtipogasto','=','tg.idtipogasto')
        ->join('gastoviaje as gv','gv.idgastocabeza','=','ge.idgastocabeza')
        ->join('gastoviajeempleado as gve','gve.idgastoviaje','=','gv.idgastoviaje')
        ->join('empleado as e','e.idempleado','=','gve.idempleado')
        ->join('persona as p','p.identificacion','=','e.identificacion')
        ->join('proyectocabeza as pc','pc.idproyecto','=','gve.idproyecto')
        ->join('plancuentas as plc','plc.codigocuenta','=','gve.codigocuenta')
        ->select('gve.fechafactura','gve.descripcion','gve.factura',DB::raw('CONCAT(p.nombre1," ",p.nombre2," ",p.apellido1," ",p.apellido2) AS nombre'),'pc.nombreproyecto','gve.montofactura')
        ->where('ge.idgastocabeza','=',$id)     
        ->get();

        $vehiculo = DB::table('gastoencabezado as ge')
        ->join('gastoviaje as gv','gv.idgastocabeza','=','ge.idgastocabeza')
        ->join('viaje as v','v.idviaje','=','gv.idviaje')
        ->join('viajevehiculo as vv','vv.idviaje','=','v.idviaje')
        ->join('vehiculo as vhc','vhc.idvehiculo','=','vv.idvehiculo')
        ->join('vstatus as vs','vs.idvstatus','=','vhc.idvstatus')
        ->select('vv.idviajevehiculo','vhc.idvehiculo','vhc.placa','vhc.marca','vhc.color','vv.kilometrajeini','vv.kilometrajefin','vhc.kilacumulado','vs.statusvehiculo')
        ->where('ge.idgastocabeza','=',$id)
        ->get();

        return view('director.viaje.detalles',['liquida'=>$liquida,'empleado'=>$empleado,'vehiculo'=>$vehiculo]);
    }
    public function rechazados()
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
        ->select(DB::raw('CONCAT(per.nombre1," ",per.apellido1) AS nombre'),'per.identificacion','emp.idempleado','tg.tipogasto','ge.idgastocabeza','ge.montosolicitado','pc.nombreproyecto','v.fechainicio','v.fechafin')
        ->where('aj.identificacion','=',$usuario->identificacion)
        ->where('ge.statusgasto','=','Rechazado')       
        ->paginate(15);  

        return view ('director.viaje.indexre',['viaje'=>$viaje]);
    }
    public function respuestaviaje(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->validaviaje($request);
            $idge = $request->get('idge');
            $var=$request->get('rconfirma');
            $miArray = $request->items;
            if ($var == 'Autorizado') {            
                $gasto=GastoCabeza::findOrFail($idge);
                $gasto-> statusgasto = $var;
                $gasto-> observacion = $request->get('observacion');
                $gasto->save();

                if ($miArray > 0) {
                    foreach ($miArray as $key => $value) {
                        $vhc= Vehiculo::findOrFail($value['0']);
                        $vhc-> idvstatus = '3';
                        $vhc->save();
                    }
                }
                else{}
            }
            else
            {
                $gasto=GastoCabeza::findOrFail($idge);
                $gasto-> statusgasto = $var;
                $gasto-> observacion = $request->get('observacion');
                $gasto->save();

                if ($miArray > 0) {
                    foreach ($miArray as $key => $value) {
                        $vhc= Vehiculo::findOrFail($value['0']);
                        $vhc-> idvstatus = '1';
                        $vhc->save();
                    }
                }
                else{}
            }
            DB::commit();            
        } catch (Exception $e) {
            DB::rollback();
        }
        return response()->json($gasto);
    }
    public function delvhc($id)
    {
        //dd($id);
        $ve = DB::table('viajevehiculo as vh')
        ->select('vh.idvehiculo')
        ->where('vh.idviajevehiculo','=',$id)
        ->first();

        $vhc= Vehiculo::findOrFail($ve->idvehiculo);
        $vhc-> idvstatus = '1';
        $vhc->save();

        /*$vh =  ViajeV::findOrFail($id); 
            ViajeV::destroy($id);*/

        return response()->json($vhc);
    }
    public function validaviaje($request)
    {
        $rules=[
            'observacion'=>'required',
        ];
        $messages=[
            'observacion.required'=>'Ingrese una observación para poder continuar',
        ];
        $this->validate($request, $rules,$messages);
    }
}