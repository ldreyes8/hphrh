<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UFormRequest;
use App\Empleado;
use App\Persona;
use App\Referencia;
use App\Deudas;
use App\Padecimientos;
use App\Experiencia;
use App\User;  
use DB;

use Validator;


use App\Academico;
use App\Familia;
use Illuminate\Http\File;

use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UController extends Controller
{
	public function __construct()
    {
        //$this->middleware('auth');
    }
    
    public function index(Request $request)
	{
		if($request)
		{
			$query=trim($request->get('searchText'));
			$usuarios=DB::table('users')->where('name','LIKE','%'.$query.'%')
				->orderBy('id','desc')
				->paginate(7);
			return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
		}
	}
	
	public function create()
	{
		//return view("seguridad.usuario.create",["personas"=>$personas,"articulos"=>$articulos]);
		//$empleados=DB::table('persona')->where('tipo_persona','=','empleado')->get();
		//return view("seguridad.usuario.create",["empleados"=>$empleados]);
		$usuario = user::all();
		return view("seguridad.usuario.create",["usuario"=>$usuario]);
	}
	public function store(UFormRequest $request)
	{
		$usuario=new User;
		$usuario->name=$request->get('name');
		$usuario->email=$request->get('email');
		$usuario->password=bcrypt($request->get('password'));
		$usuario->identificacion=$request->get('identificacion');
		$usuario->save();
		return Redirect::to('seguridad/usuario');		
	}
	public function edit($id)
	{
		return view('seguridad.usuario.edit',["usuario"=>User::findOrFail($id)]);
	}
	
	public function update(UsuarioFormRequest $request, $id)
	{
		$usuario=User::findOrFail($id);
		$usuario->name=$request->get('name');
		$usuario->email=$request->get('email');
		$usuario->password=bcrypt($request->get('password'));
		$usuario->id_persona=$request->get('id_persona');
		$usuario->update();
		return Redirect::to('seguridad/usuario');
	}
	
	public function destroy($id)
	{
		$usuario =DB::table('users')->where('idusuario','=',$id)->delete();
		return Redirect::to('seguridad/usuario');
	}

    public function cambiar_password(Request $request){
                $this->validateRequestPassword($request);

        $id=$request->get('idusuario');
       
       

        $usuario=User::find($id);


        $password=$request->input("password");

        $usuario->password=bcrypt($password);


        $r=$usuario->save();

        if($r){
            return response()->json($usuario);
        }
        else
        {
            return view("mensajes.msj_rechazado")->with("msj","Error al actualizar el password");
        }
    }

	public function galeria()
	{
        /*
        $users=DB::table('users as U')
        ->join('persona as per','U.identificacion','=','per.identificacion')
        ->join('empleado as emp','per.identificacion','=','emp.identificacion')
        ->select('U.name','U.email','emp.celcorporativo','U.fotoperfil')
        ->get();

        */
        $users=DB::table('users as U')
        ->join('persona as per','U.identificacion','=','per.identificacion')
        ->join('empleado as emp','per.identificacion','=','emp.identificacion')
        ->join('nomytras as nt','emp.idempleado','=','nt.idempleado')
        ->join('puesto as p','nt.idpuesto','=','p.idpuesto')
        ->join('afiliado as a','nt.idafiliado','=','a.idafiliado')
        ->select('U.name','U.email','emp.celcorporativo','U.fotoperfil','p.nombre as puesto','a.nombre as afiliado')
        ->where('u.id','!=',Auth::user()->id)
        ->get();
        
		/*
		$data =  array("users"=>$users);
		return json_encode($data);*/
		return view("hr.galeria",["usuario"=>$users]);
		
	}


	 public function subirimagen(Request $request)
    {
        $id=$request->input('idusuario');
        $user =User::findOrFail($id);
      	
    	$fotoperfil = $request->file('fotoperfil');
        

        $input  = array('image' => $fotoperfil) ;
        $reglas = array('image' => 'required|image|mimes:jpeg,jpg,png|max:2000');
        $validacion = Validator::make($input,  $reglas);

        if ($validacion->fails())
        {
           
          return view("mensajes.msj_rechazado")->with("msj","El archivo no es una imagen valida");
        }
        else
        {  
            $file = $user->fotoperfil;
            Storage::delete(public_path().$file);

            $nombre_original=$fotoperfil->getClientOriginalName();
            $extension=$fotoperfil->getClientOriginalExtension();
            $nuevo_nombre="userimagen-".$id.".".$extension;
            $r1=Storage::disk('fotografias')->put($nuevo_nombre,  \File::get($fotoperfil) );
            $rutadelaimagen=$nuevo_nombre;

        
            if ($r1){

                $usuario=User::find($id);
                $usuario->fotoperfil=$rutadelaimagen;
                $r2=$usuario->save();
                 return view("mensajes.msj_correcto")->with("msj","Imagen agregada correctamente");
            }
            else
            {
                return view("mensajes.msj_rechazado")->with("msj","no se cargo la imagen");
            }

        }   

    }

    public static function  getTowns(Request $request, $id)
    {
        if ($request->ajax())
        {
            $towns = DB::table('departamento as depa')
            ->join('municipio as muni','depa.iddepartamento','=','muni.iddepartamento')
            ->select ('muni.idmunicipio','muni.nombre')
            ->where('muni.iddepartamento','=',$id)
            ->get();
            return response()->json($towns);
        }
    }

    public function listaracademico()
    {
        
        $departamento=DB::table('departamento')->get();
        $nivelacademico = DB::table('nivelacademico')->get();
        $academico = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('personaacademico as pa','e.identificacion','=','pa.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select('e.idempleado','p.identificacion','pa.titulo','pa.establecimiento','pa.duracion','pa.fingreso','pa.fsalida','pa.idmunicipio','pa.identificacion','pa.idnivel','pa.periodo','na.nombrena')
        ->where('u.id','=',Auth::user()->id)
        ->get();

        $empleado = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->select('e.idempleado','p.identificacion')
        ->where('u.id','=',Auth::user()->id)
        ->get();
     
        return view("hr.academico",["departamento"=>$departamento,"nivelacademico"=>$nivelacademico,"empleado"=>$empleado,"academico"=>$academico]);
        
    }

    public function listarfamiliar()
    {

        $familia = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->join('personafamilia as pf','e.identificacion','=','pf.identificacion')
        ->select('e.idempleado','p.identificacion','pf.parentezco','pf.ocupacion','pf.edad','pf.nombref','pf.apellidof','pf.telefonof','pf.emergencia')
        ->where('u.id','=',Auth::user()->id)
        ->get();

        $empleado = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->select('e.idempleado','p.identificacion')
        ->where('u.id','=',Auth::user()->id)
        ->get();
         return view("hr.familia",["familia"=>$familia,"empleado"=>$empleado]);
    }

     public function listarpersonal()
    {

    }

    public function agregaracademico(Request $request)
    {
        $this->validateRequest($request);
        $academico = new Academico;

        $fechaingreso = $request->fecha_ingreso; 
        $fechasalida = $request->fecha_salida;


        $fechaingreso = Carbon::createFromFormat('d-m-Y',$fechaingreso);
        $fechasalida = Carbon::createFromFormat('d-m-Y',$fechasalida);

        $fechaingreso = $fechaingreso->toDateString();
        $fechasalida = $fechasalida->toDateString();

        $academico->titulo = $request->get('titulo');
        $academico->establecimiento = $request->get('establecimiento');
        $academico->duracion = $request->get('duracion');
        $academico->fingreso = $fechaingreso;
        $academico->fsalida = $fechasalida;
        $academico->idmunicipio = $request->get('idmunicipio');
        $academico->idempleado = $request->get('idempleado');
        $academico->identificacion = $request->get('identificacion');
        $academico->idnivel = $request->get('idnivel');
        $academico->periodo = $request->get('periodo');

        //$data = $request->toArray();
        //$academico = Academico::create($data);
        $academico->save();
                
        return response()->json($academico);

    }

    public function listarreferencia(Request $request)
    {
        $referencia = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->join('personareferencia as pr','e.identificacion','=','pr.identificacion')
        ->select('e.idempleado','p.identificacion','pr.nombrer','pr.telefonor','pr.profesion','pr.tiporeferencia')
        ->where('u.id','=',Auth::user()->id)
        ->get();

        $empleado = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->select('e.idempleado','p.identificacion')
        ->where('u.id','=',Auth::user()->id)
        ->first();
         return view("hr.referencias",["referencia"=>$referencia,"empleado"=>$empleado]); 
    }

    public function listarcredito(Request $request)
    {
        $deuda = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->join('personadeudas as pd','e.identificacion','=','pd.identificacion')
        ->select('e.idempleado','p.identificacion','pd.acreedor','pd.amortizacionmensual','pd.montodeuda')
        ->where('u.id','=',Auth::user()->id)
        ->get();

        $empleado = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->select('e.idempleado','p.identificacion')
        ->where('u.id','=',Auth::user()->id)
        ->first();
         return view("hr.credito",["deuda"=>$deuda,"empleado"=>$empleado]); 
    }

    public function listarpadecimiento(Request $request)
    {
        $padecimiento = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->join('personapadecimientos as pp','e.identificacion','=','pp.identificacion')
        ->select('e.idempleado','p.identificacion','pp.nombre')
        ->where('u.id','=',Auth::user()->id)
        ->get();

        $empleado = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->select('e.idempleado','p.identificacion')
        ->where('u.id','=',Auth::user()->id)
        ->first();
         return view("hr.padecimientos",["padecimiento"=>$padecimiento,"empleado"=>$empleado]);
    }

    public function listarexperiencia(Request $request)
    {
        $experiencia = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->join('personaexperiencia as pe','e.identificacion','=','pe.identificacion')
        ->select('e.idempleado','p.identificacion','pe.empresa','pe.puesto','pe.jefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex')
        ->where('u.id','=',Auth::user()->id)
        ->get();

        $empleado = DB::table('empleado as e')
        ->join('persona as p','e.identificacion','=','p.identificacion')
        ->join('users as u','p.identificacion','=','u.identificacion')
        ->select('e.idempleado','p.identificacion')
        ->where('u.id','=',Auth::user()->id)
        ->first();
         return view("hr.experiencia",["experiencia"=>$experiencia,"empleado"=>$empleado]);
    }

    public function agregarfamiliar(Request $request)
    {
        $this->validateRequestF($request);
        $familia = new Familia;
        $familia->parentezco = $request->get('parentezco');
        $familia->ocupacion = $request->get('ocupacion');
        $familia->edad = $request->get('edad');
        $familia->nombref = $request->nombre;
        $familia->apellidof = $request->apellido;
        $familia->telefonof = $request->get('telefonof');
        $familia->idempleado = $request->get('idempleado');
        $familia->identificacion = $request->get('identificacion');
        $familia->emergencia = $request->get('emergencia');

        $familia->save();

        return response()->json($familia);
    }

    public function agregarreferencia(Request $request)
    {
        $this->validateRequestR($request);
        $familia = new referencia;
        $familia->nombrer = $request->get('nombre');
        $familia->telefonor = $request->get('telefono');
        $familia->profesion = $request->get('profesion');
        $familia->tiporeferencia = $request->get('tiporeferencia');
        $familia->idempleado = $request->get('idempleado');
        $familia->identificacion = $request->get('identificacion');

        $familia->save();

        return response()->json($familia);
    }

    public function agregarcredito(Request $request)
    {
        $this->validateRequestC($request);
        $familia = new deudas;
        $familia->acreedor = $request->get('acreedor');
        $familia->amortizacionmensual = $request->get('amortizacionmensual');
        $familia->montodeuda = $request->get('montodeuda');
        $familia->idempleado = $request->get('idempleado');
        $familia->identificacion = $request->get('identificacion');

        $familia->save();

        return response()->json($familia);
    }

    public function agregarpadecimiento(Request $request)
    {
        $this->validateRequestP($request);
        $familia = new padecimientos;
        $familia->nombre = $request->get('nombre');
         $familia->idempleado = $request->get('idempleado');
        $familia->identificacion = $request->get('identificacion');

        $familia->save();

        return response()->json($familia);
    }

    public function agregarexperiencia(Request $request)
    {
        $this->validateRequestE($request);
        $familia = new experiencia;
        $familia->empresa = $request->get('empresa');
        $familia->puesto = $request->get('puesto');
        $familia->jefeinmediato = $request->get('jefeinmediato');
        $familia->motivoretiro = $request->get('motivoretiro');
        $familia->ultimosalario = $request->get('ultimosalario');
        $familia->fingresoex = $request->get('año_ingreso');
        $familia->fsalidaex = $request->get('año_salida');
        $familia->idempleado = $request->get('idempleado');
        $familia->identificacion = $request->get('identificacion');

        $familia->save();

        return response()->json($familia);
    }

    public function validateRequest($request){
        $rules=[
        'titulo' => 'required|max:100',
        'establecimiento' => 'required|max:100',
        'duracion'=> 'required|max:2',
        'fecha_salida'=>'required',
        'fecha_ingreso'=>'required',

        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }

    public function validateRequestF($request){
        $rules=[
        'parentezco' => 'required|max:40',
        'ocupacion' => 'required|max:40',
        'edad'=> 'required|max:3',
        'nombre'=>'required|max:40',
        'apellido'=>'required|max:40',


        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }

    public function validateRequestR($request){
        $rules=[
        'nombre' => 'required|max:75',
        'telefono' => 'required|max:11',
        'tiporeferencia'=> 'required|max:25',
        'profesion'=>'required|max:100',


        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }

    public function validateRequestC($request){
        $rules=[
        'acreedor' => 'required|max:60',
        'amortizacionmensual' => 'required|max:10',
        'montodeuda'=> 'required|max:10',


        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }

    public function validateRequestP($request){
        $rules=[
        'nombre' => 'required|max:60',

        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }

    public function validateRequestE($request){
        $rules=[
        'empresa' => 'required|max:100',
        'puesto' => 'required|max:50',
        'jefeinmediato' => 'required|max:50',
        'motivoretiro' => 'required|max:40',
        'ultimosalario' => 'required|max:10',
        'año_ingreso' => 'required|max:4',
        'año_salida' => 'required|max:4',


        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }


    public function validateRequestPassword($request){
        $rules=[
        'password' => 'required',

        ];
        $messages=[
        'required' => 'Debe ingresar :attribute.',
        'max'  => 'La capacidad del campo :attribute es :max',
        ];
        $this->validate($request, $rules,$messages);        
    }
}
