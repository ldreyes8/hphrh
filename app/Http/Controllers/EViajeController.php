<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\GastoEncabezado;
use App\GastoViajeEmpleado;
use App\Viaje;
use App\ViajeVehiculo;
use App\GastoViaje;
use App\Vehiculo;
use App\Persona;
use App\Constants;
use Illuminate\Support\Collection as Collection;

use Carbon\Carbon;  // para poder usar la fecha y hora
class EViajeController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    // metodos del viaje
    public function index(){
        return view ('empleado.viaje.index');
    }

    public function viaje(){
        $empleado = DB::table('empleado as emp')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->join('users as U','per.identificacion','=','U.identificacion')
            ->select('emp.idempleado')
            ->where('U.id','=',Auth::user()->id)
            ->first();

        $viaje = DB::table('gastoencabezado as gas')
            ->join('tipogasto as tga','gas.idtipogasto','=','tga.idtipogasto')
            ->join('proyectocabeza as pca','gas.idproyecto','=','pca.idproyecto')
            ->join('empleado as emp','gas.idempleado','=','emp.idempleado')
            ->join('gastoviaje as gvi','gas.idgastocabeza','=','gvi.idgastocabeza')
            ->join('viaje as via','gvi.idviaje','=','via.idviaje')
            ->select('gas.fechasolicitud','via.fechainicio','via.fechafin','gas.montosolicitado','gas.statusgasto','tga.tipogasto')
            ->where('emp.idempleado','=',$empleado->idempleado)
            ->where('tga.idtipogasto','=',2)
            ->get();

        return view ('empleado.viaje.indexviaje',["viaje"=>$viaje]);
    }

    public function obtenerstatus()
    {
        $ausencia= DB::table('gastoencabezado as gen')
        ->join('empleado as emp','gen.idempleado','=','emp.idempleado')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('gen.statusgasto')
        ->orderBy('gen.idgastocabeza','DESC')
        ->where('idtipogasto','=','2')
        ->where('U.id','=',Auth::user()->id)
        ->first();


        if($ausencia === null)
        {
          $autorizacion = "ninguno";
        }
        else
        {
          $autorizacion = $ausencia->statusgasto;
        }

        return response()->json($autorizacion);

    }

    public function addv(){
        $proyectos = DB::table('proyectocabeza as pca')
        ->select('pca.idproyecto','pca.nombreproyecto as proyecto')
        ->get();

        $vehiculos = DB::table('vehiculo as veh')
        ->join('vstatus as vst','veh.idvstatus','=','vst.idvstatus')
        ->select('veh.color','veh.marca','veh.modelo','veh.idvehiculo')
        ->where('veh.idvstatus','=',1)
        ->get();

        $eles = DB::table('codigointerno as cin')
        ->join('codigoraiz as cra','cin.idele','=','cra.idele')
        ->select('cin.codigo','cin.nombre','cra.codigo as L','cra.nombre as craiz')
        ->get();

        return view ('empleado.viaje.create',["eles"=>$eles,"proyectos"=>$proyectos,"vehiculos"=>$vehiculos]);
    }

    public function cargarbusqueda()
    {
        $emp = DB::table('empleado as emp')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('per.idafiliado')
        ->where('U.id','=', Auth::user()->id)
        ->first();

        $vehiculos = DB::table('vehiculo as veh')
        ->join('vstatus as vst','veh.idvstatus','=','vst.idvstatus')
        ->select('veh.placa','veh.color','veh.marca','veh.modelo','veh.kilacumulado','veh.idvehiculo','vst.statusvehiculo as status')
        ->where('veh.idvstatus','=',1)
        ->where('veh.idafiliado','=',$emp->idafiliado)
        ->orwhere('veh.idvstatus','=',2)
        ->where('veh.idafiliado','=',$emp->idafiliado)
        ->get();

        return view('empleado.viaje.modalbuscar',["vehiculos"=>$vehiculos]);
    }

    public function store(Request $request)
    {
        try 
        {
            DB::beginTransaction();

            $this->validateRequest($request);

            $fechainicio = $request->fecha_inicio; 
            $fechafinal = $request->fecha_final;

            $fechainicio = Carbon::createFromFormat('d/m/Y',$fechainicio);
            $fechafinal = Carbon::createFromFormat('d/m/Y',$fechafinal);

            $fini = $fechainicio;
            $ffin = $fechafinal;

            $fechainicio = $fechainicio->toDateString();
            $fechafinal = $fechafinal->toDateString();

            if($fechafinal >= $fechainicio){

                //Gasto encabezado
                $encabezado = new GastoEncabezado;
                $viaje = new Viaje;
                $gastoviaje = new  GastoViaje;

                $days = 1;

                while ($ffin >= $fini) {
                    if($fini != $ffin){
                        $days++;
                        $fini->addDay();
                    }
                    else{
                        break;
                    }
                }

                $mytime = Carbon::now('America/Guatemala');
                $today = Carbon::now();
                $year = $today->format('Y');
                $month = $today->format('m');

                $empleado = DB::table('empleado as emp')
                ->join('persona as per','emp.identificacion','=','per.identificacion')
                ->join('users as U','per.identificacion','=','U.identificacion')
                ->select('emp.idempleado')
                ->where('U.id','=',Auth::user()->id)
                ->first();

                $encabezado-> fechasolicitud = $mytime->toDateString(); 
                $encabezado-> montosolicitado = $request->monto_solicitado;
                $encabezado-> chequetransfe = $request->cheque_o_transferencia;
                $encabezado-> montogastado = 0;
                $encabezado-> fechaliquidacion = $mytime->toDateString();
                $encabezado-> moneda = $request->moneda;
                $encabezado-> periodo = $year.'/'.$month;
                $encabezado-> idtipogasto = 2;
                $encabezado-> idproyecto = $request->proyecto;
                $encabezado-> idempleado = $empleado->idempleado;
                $encabezado-> statusgasto = 'solicitado';
                $encabezado-> statuspago = 0;

                $encabezado->save();

                $viaje-> fechainicio = $fechainicio;
                $viaje-> fechafin = $fechafinal;
                $viaje-> numerodias = $days;
                $viaje-> motivo = $request->motivo;

                $viaje->save();

                $gastoviaje-> idgastocabeza = $encabezado->idgastocabeza;
                $gastoviaje-> idviaje = $viaje->idviaje;
                $gastoviaje->save();

                if($request->veh === 'Si'){
                    $this->validateRequestVeh($request);
                    $miArray = $request->vehiculo;

                    foreach ($miArray as $key => $value) {
                        $viajeveh = new ViajeVehiculo;

                        $viajeveh->idviaje = $viaje->idviaje;
                        $viajeveh->idvehiculo = $value['0'];
                        $viajeveh->kilometrajeini = $value['1'];
                        $viajeveh->kilometrajefin = 0;
                        //$viajeveh->status = 'solicitado';
                        $viajeveh->save();
                    }
                }
            }
            else{
                return response()->json(array('error'=>'la fecha inicio no puede ser mayor que la fecha final'),404);
            }

            DB::commit();
        }catch (\Exception $e) 
        {
          DB::rollback();
          return response()->json(array('error' => 'No se ha podido enviar la solicitud'),404);         
        }
        return response()->json($encabezado);
    }

    // metodos de una nueva liquidación
    public function liquidar(){
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
            ->where('gen.idempleado','=',$emp->idempleado)
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
                ->select('per.nombre1','per.nombre2','gve.factura','gve.fechafactura as fecha','gve.montofactura as monto','gve.descripcion','pcu.nombrecuenta as cuenta','pro.nombreproyecto as proyecto','gve.idgastoempleado')
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

            return view ('empleado.viaje.indexliquidar',["proyecto"=>$proyecto,"gastoviajeemp"=>$gastoviajeemp,"vehiculo"=>$vehiculo,"liquidar"=>$liquidar,"liquidacion"=>$liquidacion]);
        }
    }

    public function add($id,$idp){
        $afiliado = DB::table('afiliado as afi')
            ->join('persona as per','afi.idafiliado','=','per.idafiliado')
            ->join('users as U','per.identificacion','=','U.identificacion')
            ->select('afi.idafiliado')
            ->where('U.id','=',Auth::user()->id)
            ->first();

        $nomy = DB::table('nomytras as ntr')
            ->select('ntr.idpuesto','ntr.idempleado','ntr.idafiliado')
            ->where('ntr.idempleado','=',$id)
            ->where('ntr.idcaso','=',6)
            ->orwhere('ntr.idempleado','=',$id)
            ->where('ntr.idcaso','=',4)
            ->orwhere('ntr.idempleado','=',$id)
            ->where('ntr.idcaso','=',7)
            ->orderby('ntr.idnomytas','desc')
            ->first();
        
        //$produccion=Produccion::findOrFail($id);

        $genc = GastoEncabezado::findOrFail($idp);

        $empleado = new Persona();
        $empleado = $empleado->selectQuery(Constants::AFILIADO_EMPLEADO,array('idafiliado'=>$nomy->idafiliado));

        $cuenta = DB::table('plancuentas as c')
            ->select('c.codigocuenta','c.nombrecuenta')
            ->get();
        return view('empleado.viaje.row',["empleado"=>$empleado,"cuenta"=>$cuenta,"gencabezado"=>$genc]);
    }

    public function addl()
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
            ->where('gen.idempleado','=',$emp->idempleado)
            ->select('gen.idgastocabeza','gen.fechasolicitud','gen.montosolicitado as monto','gen.chequetransfe','gen.moneda','gen.periodo','gen.idproyecto','pca.nombreproyecto','via.fechainicio','via.fechafin','gen.idempleado','gen.idgastocabeza','gvi.idgastoviaje')
            ->orderby('gen.idgastocabeza','desc')
            ->first();

        $gastoviajeemp = DB::table('gastoviajeempleado as gve')
            ->join('proyectocabeza as pro','gve.idproyecto','=','pro.idproyecto')
            ->join('gastoviaje as gvi','gve.idgastoviaje','=','gvi.idgastoviaje')
            ->join('empleado as emp','gve.idempleado','=','emp.idempleado')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->join('plancuentas as pcu','gve.codigocuenta','pcu.codigocuenta')
            ->select('per.nombre1','per.nombre2','gve.factura','gve.fechafactura as fecha','gve.montofactura as monto','gve.descripcion','pcu.nombrecuenta as cuenta','pro.nombreproyecto as proyecto','gve.idgastoempleado')
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


        $genc = GastoEncabezado::findOrFail($proyecto->idgastocabeza);

        $empleado = new Persona();
        $empleado = $empleado->selectQuery(Constants::AFILIADO_EMPLEADO,array('idafiliado'=>$nomy->idafiliado));

        $cuenta = DB::table('plancuentas as c')
            ->select('c.codigocuenta','c.nombrecuenta')
            ->get();

        return view ('empleado.viajeliquidacion.create',["proyecto"=>$proyecto,"empleado"=>$empleado,"cuenta"=>$cuenta,"gencabezado"=>$genc,"proyectos"=>$proyectos,"gastoviajeemp"=>$gastoviajeemp]);        
    }

    public function storel(Request $request)
    {
        $this->validateRequestViaje($request);        
        try 
        {
            DB::beginTransaction();

            $fechafactura = $request->fecha_factura;
            $fechafactura = Carbon::createFromFormat('d/m/Y',$fechafactura);
            $fechafactura = $fechafactura->toDateString();

            //Gasto viaje empleado
            $gastoempleado = new GastoViajeEmpleado;
            $gastoempleado->idempleado   = $request->empleado;
            $gastoempleado->factura      = $request->factura;
            $gastoempleado->fechafactura = $fechafactura;
            $gastoempleado->montofactura = $request->monto;
            $gastoempleado->descripcion  = $request->descripcion;
            $gastoempleado->codigocuenta = $request->cuenta;
            $gastoempleado->idproyecto   = $request->proyecto;
            $gastoempleado->idgastoviaje = $request->gastoviaje;

            $gastoempleado->save();

            $gastoviajeemp = DB::table('gastoviajeempleado as gve')
                ->join('proyectocabeza as pro','gve.idproyecto','=','pro.idproyecto')
                ->join('gastoviaje as gvi','gve.idgastoviaje','=','gvi.idgastoviaje')
                ->join('empleado as emp','gve.idempleado','=','emp.idempleado')
                ->join('persona as per','emp.identificacion','=','per.identificacion')
                ->join('plancuentas as pcu','gve.codigocuenta','pcu.codigocuenta')
                ->select('per.nombre1','per.nombre2','gve.factura','gve.fechafactura as fecha','gve.montofactura as monto','gve.descripcion','pcu.nombrecuenta as cuenta','pro.nombreproyecto as proyecto','gve.idgastoempleado')
                ->where('gve.idgastoempleado','=',$gastoempleado->idgastoempleado)
                ->first();

            DB::commit();
        }catch (\Exception $e) 
        {
          DB::rollback();
          return response()->json(array('error' => 'No se ha podido enviar la solicitud'),404);         
        }
        return response()->json($gastoviajeemp);
    }

    //fechagasto , descripcion, factura, empleado, cuenta, l10, 
    //donador, proyecto, funcion l2, monto, saldo
    public function editl(Request $request,$id)
    {   
        //idempleado, factura, fechafactura, montofactura, descripcion, codigocuenta, idproyecto.
        $gastoempleado = DB::table('gastoviajeempleado as gvi')
            ->join('proyectocabeza as pca','gvi.idproyecto','=','pca.idproyecto')
            ->join('plancuentas as pcu','gvi.codigocuenta','=','pcu.codigocuenta')
            ->join('empleado as emp','gvi.idempleado','=','emp.idempleado')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->select('gvi.idgastoempleado','emp.idempleado','per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','per.apellido3',
                    'gvi.factura','gvi.fechafactura','gvi.montofactura','gvi.descripcion','pcu.codigocuenta','pcu.nombrecuenta as cuenta',
                    'pca.idproyecto','pca.nombreproyecto as proyecto')
            ->where('gvi.idgastoempleado','=',$id)
            ->first();

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
            ->where('gen.idempleado','=',$emp->idempleado)
            ->select('gen.idgastocabeza','gen.fechasolicitud','gen.montosolicitado as monto','gen.chequetransfe','gen.moneda','gen.periodo','gen.idproyecto','pca.nombreproyecto','via.fechainicio','via.fechafin','gen.idempleado','gen.idgastocabeza','gvi.idgastoviaje')
            ->orderby('gen.idgastocabeza','desc')
            ->first();

        $gastoviajeemp = DB::table('gastoviajeempleado as gve')
            ->join('proyectocabeza as pro','gve.idproyecto','=','pro.idproyecto')
            ->join('gastoviaje as gvi','gve.idgastoviaje','=','gvi.idgastoviaje')
            ->join('empleado as emp','gve.idempleado','=','emp.idempleado')
            ->join('persona as per','emp.identificacion','=','per.identificacion')
            ->join('plancuentas as pcu','gve.codigocuenta','pcu.codigocuenta')
            ->select('per.nombre1','per.nombre2','gve.factura','gve.fechafactura as fecha','gve.montofactura as monto','gve.descripcion','pcu.nombrecuenta as cuenta','pro.nombreproyecto as proyecto','gve.idgastoempleado')
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

        //$genc = GastoEncabezado::findOrFail($proyecto->idproyecto);

        $empleado = new Persona();
        $empleado = $empleado->selectQuery(Constants::AFILIADO_EMPLEADO,array('idafiliado'=>$nomy->idafiliado));

        $cuenta = DB::table('plancuentas as c')
            ->select('c.codigocuenta','c.nombrecuenta')
            ->get();

        return view ('empleado.viajeliquidacion.edit',["empleado"=>$empleado,"cuenta"=>$cuenta,"gastoempleado"=>$gastoempleado,"proyectos"=>$proyectos,"gastoviajeemp"=>$gastoviajeemp]);
    }

    public function updatel(Request $request, $id){
        $idgastoempleado = $id;
        $this->validateRequestViaje($request);
        try 
        {
            DB::beginTransaction();
        
            $fechafactura = $request->fecha_factura;
            $fechafactura = Carbon::createFromFormat('d/m/Y',$fechafactura);
            $fechafactura = $fechafactura->toDateString();
            //Gasto viaje empleado
            $gastoempleado = GastoViajeEmpleado::findOrFail($id);

            $gastoempleado->idempleado   = $request->empleado;
            $gastoempleado->factura      = $request->factura;
            $gastoempleado->fechafactura = $fechafactura;
            $gastoempleado->montofactura = $request->monto;
            $gastoempleado->descripcion  = $request->descripcion;
            $gastoempleado->codigocuenta = $request->cuenta;
            $gastoempleado->idproyecto   = $request->proyecto;
            $gastoempleado->idgastoviaje = $request->gastoviaje;

            $gastoempleado->save();

            $gastoviajeemp = DB::table('gastoviajeempleado as gve')
                ->join('proyectocabeza as pro','gve.idproyecto','=','pro.idproyecto')
                ->join('gastoviaje as gvi','gve.idgastoviaje','=','gvi.idgastoviaje')
                ->join('empleado as emp','gve.idempleado','=','emp.idempleado')
                ->join('persona as per','emp.identificacion','=','per.identificacion')
                ->join('plancuentas as pcu','gve.codigocuenta','pcu.codigocuenta')
                ->join('gastoencabezado as gen','gvi.idgastocabeza','=','gen.idgastocabeza')
                ->select('per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','per.apellido3','gve.factura',(DB::raw('DATE_FORMAT(gve.fechafactura,"%d/%m/%Y") as fecha')),'gve.montofactura as monto','gve.descripcion','pcu.nombrecuenta as cuenta','pro.nombreproyecto as proyecto','gve.idgastoempleado','gen.montosolicitado as montot')
                ->where('gve.idgastoempleado','=',$gastoempleado->idgastoempleado)
                ->first();

            DB::commit();
        }catch (\Exception $e) 
        {
          DB::rollback();
          return response()->json(array('error' => 'No se ha podido enviar la solicitud'),404);         
        }
        return response()->json($gastoviajeemp);
    }

    public function updateml()// update monto liquidacion y monto disponible
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
            ->where('gen.idempleado','=',$emp->idempleado)
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

    public function enviol(Request $request)
    {
        $idgasto = $request->gastocabeza;
        $gastoencabezado = GastoEncabezado::findOrFail($idgasto);
        $gastoencabezado->statusgasto = 'solicitado';
        $gastoencabezado->save();

        return response()->json($gastoencabezado);
    }

    public function vehedit($id)
    {
        $viajeveh = DB::table('viajevehiculo as vve')
        ->select('vve.idviajevehiculo','vve.kilometrajefin')
        ->where('vve.idviajevehiculo','=',$id)
        ->first();

        return response()->json($viajeveh);

    }

    public function vehupdate(Request $request, $id)
    {

        //$this->validateRequestViaje($request);
        try 
        {
            DB::beginTransaction();
            $viajeveh = ViajeVehiculo::findOrFail($id);
            $viajeveh->kilometrajefin = $request->kilometraje_final;
            $viajeveh->save();

            $vehiculo = DB::table('viajevehiculo as vve')
            ->join('vehiculo as veh','vve.idvehiculo','=','veh.idvehiculo')
            ->select('veh.placa','veh.color','veh.marca','veh.modelo','veh.kilacumulado','vve.idviajevehiculo','vve.kilometrajeini','vve.kilometrajefin')
            ->where('vve.idviajevehiculo','=',$viajeveh->idviajevehiculo)
            ->first();

            DB::commit();
        }catch (\Exception $e) 
        {
          DB::rollback();
          return response()->json(array('error' => 'No se ha podido enviar la solicitud'),404);         
        }

        return response()->json($vehiculo);

    }

    public function validateRequest($request){
        $rules=[
        'fecha_inicio' => 'required',
        'fecha_final' => 'required',
        ];
        $messages=[
          'required' => 'Debe ingresar :attribute.',
          'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }

    public function validateRequestVeh($request){
        $rules=[
        'vehiculo' => 'required',
        ];
        $messages=[
          'required' => 'Debe ingresar :attribute.',
          'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }

    public function validateRequestViaje($request){
        $rules=[
        'fecha_factura' => 'required',
        'factura' => 'required',
        'monto' => 'required',
        'empleado' => 'required',
        'proyecto' => 'required',
        ];
        $messages=[
          'required' => 'Debe ingresar :attribute.',
          'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }
}

/*

        $empleado = DB::table('persona as per')
        ->join('empleado as emp','per.identificacion','=','emp.identificacion')
        ->join('afiliado as afi','per.idafiliado','=','afi.idafiliado')
        ->select('per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','per.apellido3','emp.idempleado')
        ->where('afi.idafiliado','=',$nomy->idafiliado)
        ->where('emp.idstatus','=',2)
        ->orderby('per.nombre1','asc')
        ->get();*/
