<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use App\Persona;
use App\Vehiculo;
use App\GastoCabeza;
use Validator;
use ViajeV;
use App\Constants;
class JIViajeController extends Controller
{
    public function index()
    {
    	return view ('director.viaje.index');
    }
    public function indexas()
    {
        return view ('asistente.viaje.index');
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
        
        $emp = DB::table('empleado as emp')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->join('users as U','per.identificacion','=','U.identificacion')
            ->select('emp.idempleado')
            ->where('U.id','=',Auth::user()->id)
            ->first();

        $proyecto = DB::table('gastoencabezado as gen','gen.idproyecto','gen.idempleado')
            ->join('proyectocabeza as pca','gen.idproyecto','=','pca.idproyecto')
            ->join('gastoviaje as gvi','gen.idgastocabeza','=','gvi.idgastocabeza')
            ->join('viaje as via','gvi.idviaje','=','via.idviaje')
            ->where('gen.statusgasto','=','Autorizado')
            //->where('gen.statusgasto','=','solicitado')
            ->where('gen.idtipogasto','=',2)
            ->where('gen.idempleado','=',$id)
            ->select('gen.idgastocabeza','gen.fechasolicitud','gen.montosolicitado as monto','gen.chequetransfe','gen.moneda','gen.periodo','gen.idproyecto','pca.nombreproyecto','via.fechainicio','via.fechafin','gen.idempleado','gen.idgastocabeza','gvi.idgastoviaje','via.idviaje')
            ->orderby('gen.idgastocabeza','desc')
            ->first();

        //dd($emp,$proyecto);

        if (empty($proyecto->idgastocabeza)) {
                $liquidar = 0;
                 return view ('empleado.viaje.indexliquidar',["liquidar"=>$liquidar]);
        }
        else{
            $liquidar = 1;

            $liquidacion= DB::table('gastoviajeempleado as gve')
            ->join('gastoviaje as gvi','gve.idgastoviaje','=','gvi.idgastoviaje')
            ->select(DB::raw('SUM(gve.montofactura) as liquidacion'))
            ->where('gvi.idgastocabeza','=',$proyecto->idgastocabeza)
            ->first();

            $gastoviajeemp = DB::table('gastoviajeempleado as gve')
                ->join('proyectocabeza as pro','gve.idproyecto','=','pro.idproyecto')
                ->join('gastoviaje as gvi','gve.idgastoviaje','=','gvi.idgastoviaje')
                ->join('empleado as emp','gve.idempleado','=','emp.idempleado')
                ->join('persona as per','emp.identificacion','=','per.identificacion')
                ->join('plancuentas as pcu','gve.codigocuenta','pcu.codigocuenta')
                ->select('per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','per.apellido3','gve.factura','gve.fechafactura as fecha','gve.montofactura as monto','gve.descripcion','pcu.nombrecuenta as cuenta','pro.nombreproyecto as proyecto','gve.idgastoempleado')
                ->where('gvi.idgastocabeza','=',$proyecto->idgastocabeza)
                ->get();

            $proyectos = DB::table('proyectocabeza as pca')
                ->select('pca.idproyecto','pca.nombreproyecto')
                ->get();

            $nomy = DB::table('nomytras as ntr')
                ->select('ntr.idpuesto','ntr.idempleado','ntr.idafiliado')
                ->where('ntr.idempleado','=',$proyecto->idempleado)
                ->where('ntr.idcaso','=',6)
                ->orwhere('ntr.idempleado','=',$proyecto->idempleado)
                ->where('ntr.idcaso','=',4)
                ->orwhere('ntr.idempleado','=',$proyecto->idempleado)
                ->where('ntr.idcaso','=',7)
                ->orderby('ntr.idnomytas','desc')
                ->first();

            //dd($proyecto);

            //$genc = GastoEncabezado::findOrFail($proyecto->idproyecto);

            //dd($genc);

            $empleado = new Persona();
            $empleado = $empleado->selectQuery(Constants::AFILIADO_EMPLEADO,array('idafiliado'=>$nomy->idafiliado));

            $cuenta = DB::table('plancuentas as c')
                ->select('c.codigocuenta','c.nombrecuenta')
                ->get();

            $vehiculo = DB::table('viajevehiculo as vve')
                ->join('vehiculo as veh','vve.idvehiculo','=','veh.idvehiculo')
                ->select('veh.placa','veh.color','veh.marca','veh.modelo','veh.kilacumulado','vve.idviajevehiculo','vve.kilometrajeini','vve.kilometrajefin')
                ->where('vve.idviaje','=',$proyecto->idviaje)
                ->get();

            return view ('director.viaje.detalles',["proyecto"=>$proyecto,"gastoviajeemp"=>$gastoviajeemp,"vehiculo"=>$vehiculo,"liquidar"=>$liquidar,"liquidacion"=>$liquidacion]);
        }
        /*$empleado = DB::table('empleado as e')
        ->join('persona as p','p.identificacion','=','e.identificacion')
        ->join('users as u','u.identificacion','=','p.identificacion')
        ->join('gastoencabezado as ge','e.idempleado','=','ge.idempleado')
        ->join('tipogasto as tg','tg.idtipogasto','=','ge.idtipogasto')
        ->select(DB::raw('CONCAT(p.nombre1," ",p.nombre2," ",p.apellido1," ",p.apellido2) AS nombre'),'e.idempleado','ge.idgastocabeza','u.email','tg.tipogasto')
        ->where('ge.idgastocabeza','=',$id)
        ->first();

        $personas = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->select(DB::raw('CONCAT(p.nombre1," ",p.nombre2," ",p.apellido1," ",p.apellido2) AS nombre'),'e.idempleado')
        ->get();

        $liquida = DB::table('gastoencabezado as ge')
        ->join('tipogasto as tg','ge.idtipogasto','=','tg.idtipogasto')
        ->join('gastoviaje as gv','gv.idgastocabeza','=','ge.idgastocabeza')
        ->join('gastoviajeempleado as gve','gve.idgastoviaje','=','gv.idgastoviaje')
        ->join('empleado as e','e.idempleado','=','gve.idempleado')
        ->join('persona as p','p.identificacion','=','e.identificacion')
        ->join('proyectocabeza as pc','pc.idproyecto','=','gve.idproyecto')
        ->join('plancuentas as plc','plc.codigocuenta','=','gve.codigocuenta')
        ->select('gve.fechafactura','gve.descripcion','gve.factura',DB::raw('CONCAT(p.nombre1," ",p.nombre2," ",p.apellido1," ",p.apellido2) AS nombre'),'e.idempleado','pc.nombreproyecto','gve.montofactura')
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

        return view('director.viaje.detalles',['liquida'=>$liquida,'empleado'=>$empleado,'vehiculo'=>$vehiculo,'personas'=>$personas]);*/
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
    public function vasistentes()
    {
        $asistente=DB::select("call pcasistente(?)",array(Auth::user()->id));
        return view('asistente.viaje.indexrev',["asistente"=>$asistente]);
    }
}