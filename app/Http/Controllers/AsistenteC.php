<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
use Carbon\Carbon;
use Response;
use App\Persona;
use App\Vehiculo;
use App\GastoCabeza;
use Validator;
use ViajeV;
use App\Constants;
use App\GastoViajeEmpleado;
use App\GastoEncabezado;
use App\Viaje;
use App\ViajeVehiculo;
use App\GastoViaje;

class AsistenteC extends Controller
{
    public function index()
    {
        return view ('asistente.viaje.index');
    }
    public function vasistentes()
    {
        $asistente=DB::select("call pcasistente(?)",array(Auth::user()->id));
        return view('asistente.viaje.indexsol',["asistente"=>$asistente]);
    }
    public function revasistentes()
    {
        $asistente=DB::select("call pcasistente2(?)",array(Auth::user()->id));
        return view('asistente.viaje.indexrev',["asistente"=>$asistente]);
    }
    public function tramite(Request $request)
    {
        $idge = $request->get('idgasto');
        $gasto=GastoCabeza::findOrFail($idge);
        $gasto-> statuspago = 1;
        $gasto->save();
        return response()->json($gasto);
    }
    public function detalleautoas($id)
    {
        $proyecto = DB::table('gastoencabezado as gen','gen.idproyecto','gen.idempleado')
            ->join('proyecto as pca','gen.idproyecto','=','pca.idproyecto')
            ->join('gastoviaje as gvi','gen.idgastocabeza','=','gvi.idgastocabeza')
            ->join('viaje as via','gvi.idviaje','=','via.idviaje')
            ->where('gen.statusgasto','=','Autorizado')
            //->where('gen.idtipogasto','=',2)
            ->where('gen.idempleado','=',$id)
            ->select('gen.idgastocabeza','gen.fechasolicitud','gen.montosolicitado as monto','gen.chequetransfe','gen.moneda','gen.periodo','gen.idproyecto','pca.nombreproyecto','via.fechainicio','via.fechafin','gen.idempleado','gen.idgastocabeza','gvi.idgastoviaje','via.idviaje')
            ->orderby('gen.idgastocabeza','desc')
            ->first();

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
                ->join('proyecto as pro','gve.idproyecto','=','pro.idproyecto')
                ->join('gastoviaje as gvi','gve.idgastoviaje','=','gvi.idgastoviaje')
                ->join('empleado as emp','gve.idempleado','=','emp.idempleado')
                ->join('persona as per','emp.identificacion','=','per.identificacion')
                ->join('plancuentas as pcu','gve.codigocuenta','pcu.codigocuenta')
                ->select('per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','per.apellido3','gve.factura','gve.fechafactura as fecha','gve.montofactura as monto','gve.descripcion','pcu.nombrecuenta as cuenta','pro.nombreproyecto as proyecto','gve.idgastoempleado','check1','check2')
                ->where('gvi.idgastocabeza','=',$proyecto->idgastocabeza)
                ->get();

            $proyectos = DB::table('proyecto as pca')
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
        return view ('asistente.viaje.detalleviaje',["proyecto"=>$proyecto,"gastoviajeemp"=>$gastoviajeemp,"vehiculo"=>$vehiculo,"liquidar"=>$liquidar,"liquidacion"=>$liquidacion]);
        }
    }
    public function revision(Request $request)
    {
    	$id=$request->get('idgasto');
    	$valor=$request->get('valores');
    	$gve=GastoViajeEmpleado::findOrFail($id);
    	$gve-> check1 = $valor;
        $gve-> save();
        return response()->json($gve);
    }
    public function revision2(Request $request)
    {
        $id=$request->get('idgasto');
        $valor=$request->get('valores');
        $gve=GastoViajeEmpleado::findOrFail($id);
        $gve-> check2 = $valor;
        $gve-> save();
        return response()->json($gve);
    }
    public function addl($id){
        $proyecto = DB::table('gastoencabezado as gen','gen.idproyecto','gen.idempleado')
            ->join('proyecto as pca','gen.idproyecto','=','pca.idproyecto')
            ->join('gastoviaje as gvi','gen.idgastocabeza','=','gvi.idgastocabeza')
            ->join('viaje as via','gvi.idviaje','=','via.idviaje')
            //->where('gen.idtipogasto','=',2)
            ->where('gen.idempleado','=',$id)
            ->select('gen.idgastocabeza','gen.fechasolicitud','gen.montosolicitado as monto','gen.chequetransfe','gen.moneda','gen.periodo','gen.idproyecto','pca.nombreproyecto','via.fechainicio','via.fechafin','gen.idempleado','gen.idgastocabeza','gvi.idgastoviaje')
            ->orderby('gen.idgastocabeza','desc')
            ->first();

        $gastoviajeemp = DB::table('gastoviajeempleado as gve')
            ->join('proyecto as pro','gve.idproyecto','=','pro.idproyecto')
            ->join('gastoviaje as gvi','gve.idgastoviaje','=','gvi.idgastoviaje')
            ->join('empleado as emp','gve.idempleado','=','emp.idempleado')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->join('plancuentas as pcu','gve.codigocuenta','pcu.codigocuenta')
            ->select('per.nombre1','per.nombre2','gve.factura','gve.fechafactura as fecha','gve.montofactura as monto','gve.descripcion','pcu.nombrecuenta as cuenta','pro.nombreproyecto as proyecto','gve.idgastoempleado')
            ->where('gvi.idgastocabeza','=',$proyecto->idgastocabeza)
            ->get();

        $proyectos = DB::table('proyecto as pca')
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

        $genc = GastoEncabezado::findOrFail($proyecto->idgastocabeza);

        $empleado = new Persona();
        $empleado = $empleado->selectQuery(Constants::AFILIADO_EMPLEADO,array('idafiliado'=>$nomy->idafiliado));

        $cuenta = DB::table('plancuentas as c')
            ->select('c.codigocuenta','c.nombrecuenta')
            ->get();

        return view ('empleado.viajeliquidacion.create',["proyecto"=>$proyecto,"empleado"=>$empleado,"cuenta"=>$cuenta,"gencabezado"=>$genc,"proyectos"=>$proyectos,"gastoviajeemp"=>$gastoviajeemp]);        
    }
    public function elimina($id)
    {
        $cre =  GastoViajeEmpleado::findOrFail($id); 
            GastoViajeEmpleado::destroy($id);
        return response()->json('Ok');
    }
    public function revisado(Request $request){
        $idgasto = $request->get('gastocabeza');
        $gastoencabezado = GastoEncabezado::findOrFail($idgasto);
        $gastoencabezado-> statusgasto = 'Revisado';
        $gastoencabezado->save();
        return response()->json($gastoencabezado);
    }
    public function updateml($id)
    {
        dd($id);
        $proyecto = DB::table('gastoencabezado as gen','gen.idproyecto','gen.idempleado')
            ->join('proyecto as pca','gen.idproyecto','=','pca.idproyecto')
            ->join('gastoviaje as gvi','gen.idgastocabeza','=','gvi.idgastocabeza')
            ->join('viaje as via','gvi.idviaje','=','via.idviaje')
            ->where('gen.statusgasto','=','Autorizado')
            ->where('gen.idempleado','=',$id)
            ->select('gen.idgastocabeza','gen.fechasolicitud','gen.montosolicitado as monto','gen.chequetransfe','gen.moneda','gen.periodo','gen.idproyecto','pca.nombreproyecto','via.fechainicio','via.fechafin','gen.idempleado','gen.idgastocabeza','gvi.idgastoviaje','via.idviaje')
            ->orderby('gen.idgastocabeza','desc')
            ->first();

            $liquidacion= DB::table('gastoviajeempleado as gve')
            ->join('gastoviaje as gvi','gve.idgastoviaje','=','gvi.idgastoviaje')
            ->select(DB::raw('SUM(gve.montofactura) as liquidacion'))
            ->where('gvi.idgastocabeza','=',$proyecto->idgastocabeza)
            ->first();

        $disponible = $proyecto->monto - $liquidacion->liquidacion;
        $calculo = array($disponible,$liquidacion->liquidacion,$proyecto->monto);
        
        return response()->json($calculo);
    }
}