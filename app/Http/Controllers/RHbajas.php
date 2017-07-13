<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Storage;
use DB;
use Carbon\Carbon; //para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Historia;

use Validator;

use App\Http\Requests\HistoriaRequest;
use App\Empleado;
use App\Persona;
use App\Bajas;
use App\User;

class RHbajas extends Controller
{

	public function index (Request $request)
    {
    	if ($request)
    	{
        $query=trim($request->get('searchText'));
        $empleado=DB::table('empleado as e')
        ->join('status as st','e.idstatus','=','st.idstatus')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        
        ->join('nomytras as nt','e.idempleado','=','nt.idempleado')
        ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
        ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')

        ->select('e.idempleado','e.identificacion','e.nit','e.afiliacionigss','e.numerodependientes','e.aportemensual','e.vivienda','e.alquilermensual','e.otrosingresos','p.nombre1','p.nombre2','p.apellido1','p.apellido2','st.statusemp as statusn','pu.nombre as puesto','af.nombre as afiliado',DB::raw('max(nt.idnomytas) as idnomytas'))
        ->where('e.idstatus','!=',5)
        ->groupBy('e.idempleado')   
        ->orderBy('e.idempleado','desc')
        ->paginate(19); 
        }

        $status = DB::table('status as st')
        ->select('st.idstatus','st.statusemp')
        ->where('st.idstatus','=',5)
        //->orwhere('st.idstatus','=',6)
        //->orwhere('st.idstatus','=',8)
        ->get();
        return view('despedir',["empleado"=>$empleado,"status"=>$status,"searchText"=>$query]);
    }

    public function bajas(request $request,$id)
    {
    	$empleado = DB::table('empleado as em')
    	->join('persona as per','per.identificacion','=','em.identificacion')
    	->where('em.idempleado','=', $id)
    	->select('per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','per.apellido3','em.idempleado','em.identificacion')
    	->first();
        return response()->json($empleado);
    }

    public function addbaja(request $request)
    {
        $this->validateRequest($request);

        try 
        {
            DB::beginTransaction();

            $idempleado = $request->idempleado;
            $identificacion = $request->identificacion;
            $fechabaja = $request->fecha_despido;
            $motivo = $request->motivo;
            $comentarios = $request->observaciones;
            $idstatus = $request->idstatus;

            $fechabaja = Carbon::createFromFormat('d/m/Y',$fechabaja);
            $fechabaja = $fechabaja->toDateString();
            $bajas = new Bajas;
            
            $bajas->fechabaja = $fechabaja;
            $bajas->motivo = $motivo;
            $bajas->comentarios = $comentarios;
            $mytime = Carbon::now('America/Guatemala');
            $bajas->fechasistema=$mytime->toDateString();
            $bajas->idempleado=$idempleado;
            
            $bajas->save();


            $empleado = empleado::find($idempleado);
            $empleado->idstatus = $idstatus;
            $empleado->save();

            $idusario = DB::table('users as U')
            ->join('persona as p','U.identificacion','=','p.identificacion')
            ->select('U.id')
            ->where('U.identificacion','=',$identificacion)
            ->first();

            $usuario = user::find($idusario->id);
            //$usuario->password=bcrypt('brcsolera12072017');
            $usuario->password=bcrypt('DespidoATM');
            $usuario->estado = 0;
            $usuario->save();

            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(array('error' => 'No se ha podido realizar la solicitud de despido'),404);      
        }

        return response()->json($bajas);
    }

    public function validateRequest($request){
        $rules=[
          'fecha_despido'=>'required',
          'observaciones'=>'required|max:300',


        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
  }

  public function debaja(request $request)
  {
    if ($request)
    {
        $query=trim($request->get('searchText'));
        $empleado=DB::table('empleado as e')
        ->join('status as st','e.idstatus','=','st.idstatus')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('nomytras as nt','e.idempleado','=','nt.idempleado')
        ->join('puesto as pu','nt.idpuesto','=','pu.idpuesto')
        ->join('afiliado as af','nt.idafiliado','=','af.idafiliado')
        ->select('e.idempleado','e.identificacion','e.nit','e.afiliacionigss','e.numerodependientes','e.aportemensual','e.vivienda','e.alquilermensual','e.otrosingresos','p.nombre1','p.nombre2','p.apellido1','p.apellido2','st.statusemp as statusn','pu.nombre as puesto','af.nombre as afiliado',DB::raw('max(nt.idnomytas) as idnomytas'))
        ->where('e.idstatus','=',4)
               
        ->paginate(19); 
        }

        return view('debaja',["empleado"=>$empleado,"searchText"=>$query]);    
    }
}
