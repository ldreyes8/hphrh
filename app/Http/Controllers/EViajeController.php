<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\GastoEncabezado;
use App\Viaje;
use App\ViajeVehiculo;
use App\GastoViaje;
use App\Vehiculo;
use Carbon\Carbon;  // para poder usar la fecha y hora
class EViajeController extends Controller
{   
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

    // metodos de una nueva liquidación
    public function liquidar(){
        $select = DB::table('gastoviaje as gvi','gvi.idproyecto','idempleado')
        ->where('statusgasto','=','autorizado')
        ->where('idtipogasto','=',2)
        ->where('idempleado','=',$emp->idempleado)
        ->orderby('gvi.idgastocabeza','desc')
        ->first();
        
    	return view ('empleado.viaje.indexliquidar',[]);
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
    
    public function add($id){
    	
        $afiliado = DB::table('afiliado as afi')
        ->join('persona as per','afi.idafiliado','=','per.idafiliado')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('afi.idafiliado')
        ->where('U.id','=',Auth::user()->id)
        ->first();

        $empleado = DB::table('persona as per')
        ->join('empleado as emp','per.identificacion','=','emp.identificacion')
        ->where('per.idafiliado','=',$afiliado->idafiliado)
        ->where('emp.idstatus','=',2)
        ->select('per.nombre1','per.nombre2','per.apellido1','per.apellido2','emp.idempleado')
        ->get();

        $cuenta = DB::table('plancuentas as c')
        ->select('c.codigocuenta','c.nombrecuenta')
        ->get();
        return view('empleado.viaje.row',["empleado"=>$empleado,"cuenta"=>$cuenta]);
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

        //if()
    }

    public function storel(Request $request)
    {
        
        try 
        {
            DB::beginTransaction();

            $this->validateRequest($request);

            $fechafactura = $request->fecha_factura;
            $fechafactura = Carbon::createFromFormat('d/m/Y',$fechafactura);
            $fechafactura = $fechafactura->toDateString();

            //Gasto viaje empleado
            $gastoempleado = new GastoViajeEmpleado;
            $gastoempleado->idempleado   = $request->empleado;
            $gastoempleado->factura      = $request->factura;
            $gastoempleado->fechafactura = $request->fechafactura;
            $gastoempleado->montofactura = $request->montofactura;
            $gastoempleado->descripcion  = $request->descripcion;
            $gastoempleado->codigocuenta = $request->codigocuenta;
            $gastoempleado->idproyecto   = $request->idproyecto;
            $gastoempleado->idgastoviaje = $request->idgastoviaje;

            $gastoempleado->save();

            DB::commit();
        }catch (\Exception $e) 
        {
          DB::rollback();
          return response()->json(array('error' => 'No se ha podido enviar la solicitud'),404);         
        }
        return response()->json($encabezado);
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
}
