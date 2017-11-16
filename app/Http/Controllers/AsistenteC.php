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
use App\GastoViajeEmpleado;
class AsistenteC extends Controller
{
    public function index()
    {
        return view ('asistente.viaje.index');
    }
    public function vasistentes()
    {
        $asistente=DB::select("call pcasistente(?)",array(Auth::user()->id));
        return view('asistente.viaje.indexrev',["asistente"=>$asistente]);
    }
    public function detalleautoas($id)
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
        return view ('asistente.viaje.detalleviaje',["proyecto"=>$proyecto,"gastoviajeemp"=>$gastoviajeemp,"vehiculo"=>$vehiculo,"liquidar"=>$liquidar,"liquidacion"=>$liquidacion]);
        }
    }
    public function revision(Request $request)
    {
    	$id=$request->get('idgasto');
    	$valor=$request->get('valores');
    	//cambios
    }
}
