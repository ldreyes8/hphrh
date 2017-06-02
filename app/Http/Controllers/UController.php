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
use App\Afiliado;  
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
    //Datos usuario
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
            ->where('U.id','!=',Auth::user()->id)
            ->get(); 
            
            
            
    		/*
    		$data =  array("users"=>$users);
    		return json_encode($data);*/
    		return view("hr.galeria",["usuario"=>$users]);
    		
    	}

        public function buscar_usuarios($afiliado,$dato="")
        {

            $usuarioactual=\Auth::user();
            $afiliados = Afiliado::all();
            $usuarios= User::Busqueda($afiliado,$dato)->paginate(25);  
            $afiliadosel = $afiliados->find($afiliado);

            return view('hr.galeria')
            ->with("afiliadosel",$afiliadosel)
            ->with("afiliados",$afiliados)
            ->with("usuarios", $usuarios )
            ->with("usuario_actual", $usuarioactual);       
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
    //Datos Academicos
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
            ->select('e.idempleado','p.identificacion','pa.idpacademico','pa.titulo','pa.establecimiento','pa.duracion','pa.fingreso','pa.fsalida','pa.idmunicipio','pa.identificacion','pa.idnivel','pa.periodo','na.nombrena')
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

        public function listaracademico1(Request $request,$id)
        {   
            $academico = DB::table('personaacademico as pa')
            ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
            ->join('municipio as m','pa.idmunicipio','=','m.idmunicipio')
            ->select('pa.idpacademico','pa.titulo','pa.establecimiento','pa.duracion',(DB::raw('DATE_FORMAT(pa.fingreso,"%d/%m/%Y") as fingreso')),(DB::raw('DATE_FORMAT(pa.fsalida,"%d/%m/%Y") as fsalida')),'pa.idmunicipio','pa.idnivel','m.nombre','na.nombrena','pa.periodo')
            ->where('pa.idpacademico','=',$id)
            ->first();

            return response()->json($academico);
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

        public function updateAca(Request $request, $id)
        {
            $academico = Academico::findOrFail($id);

            $fechaingreso = $request->fecha_ingreso; 
            $fechasalida = $request->fecha_salida;

            
            $fechaingreso = Carbon::createFromFormat('d/m/Y',$fechaingreso);
            $fechasalida = Carbon::createFromFormat('d/m/Y',$fechasalida);
            
            $fechaingreso = $fechaingreso->toDateString();
            $fechasalida = $fechasalida->toDateString();

            $academico->titulo = $request->get('titulo');
            $academico->establecimiento = $request->get('establecimiento');
            $academico->duracion = $request->get('duracion');
            $academico->fingreso = $fechaingreso;
            $academico->fsalida = $fechasalida;
            $academico->idmunicipio = $request->get('idmunicipio');
            $academico->idnivel = $request->get('idnivel');
            $academico->periodo = $request->get('periodo');
            $academico->save();
            return response()->json($academico);
        }

        public function deleteacad ($id)
        {
            $cre =  Academico::findOrFail($id); 
                    Academico::destroy($id);
            return response()->json($cre);
        }
    //Datos Familiar
        public function listarfamiliar()
        {

            $familia = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('users as u','p.identificacion','=','u.identificacion')
            ->join('personafamilia as pf','e.identificacion','=','pf.identificacion')
            ->select('e.idempleado','p.identificacion','pf.idpfamilia','pf.parentezco','pf.ocupacion','pf.edad','pf.nombref','pf.apellidof','pf.telefonof','pf.emergencia')
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

        public function listarfamilia1(Request $request,$id)
        {

            $familia = DB::table('personafamilia as pf')
            ->select('pf.idpfamilia','pf.parentezco','pf.ocupacion','pf.edad','pf.nombref','pf.apellidof','pf.telefonof','pf.emergencia')
            ->where('pf.idpfamilia','=',$id)
            ->first();
            return response()->json($familia);
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

        public function updatefam(Request $request, $id)
        {
            $familia= Familia::findOrFail($id);
            $familia-> parentezco = $request->get('parentezco');
            $familia-> ocupacion = $request->get('ocupacion');
            $familia-> edad = $request->get('edad');
            $familia-> nombref = $request->nombre;
            $familia-> apellidof = $request->apellido;
            $familia-> telefonof = $request->get('telefonof');
            $familia-> emergencia = $request->get('emergencia');
            $familia->save();

            return response()->json($familia);
        }

        public function deletefam ($id)
        {
            $cre =  Familia::findOrFail($id); 
                    Familia::destroy($id);
            return response()->json($cre);
        }

         public function listarpersonal()
        {

        }
    //Datos referencias
        public function listarreferencia(Request $request)
        {
            $referencia = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('users as u','p.identificacion','=','u.identificacion')
            ->join('personareferencia as pr','e.identificacion','=','pr.identificacion')
            ->select('e.idempleado','p.identificacion','pr.idpreferencia','pr.nombrer','pr.telefonor','pr.profesion','pr.tiporeferencia')
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

        public function listarreferencia1(Request $request,$id )
        {
            $referencia = DB::table('personareferencia as pr')
            ->select('pr.idpreferencia','pr.nombrer','pr.telefonor','pr.profesion','pr.tiporeferencia')
            ->where('pr.idpreferencia','=',$id)
            ->first();
            return response()->json($referencia);
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

        public function updateref(Request $request, $id)
        {
            $refe= Referencia::findOrFail($id);
            $refe-> nombrer = $request->get('nombre');
            $refe-> telefonor = $request->get('telefono');
            $refe-> profesion = $request->get('profesion');
            $refe-> tiporeferencia = $request->get('tiporeferencia');
            $refe->save();
            return response()->json($refe);
        }
        public function deleteref ($id)
        {
            $cre =  Referencia::findOrFail($id); 
                    Referencia::destroy($id);
            return response()->json($cre);
        }
    //Datos creditos
        public function listarcredito(Request $request)
        {
            $deuda = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('users as u','p.identificacion','=','u.identificacion')
            ->join('personadeudas as pd','e.identificacion','=','pd.identificacion')
            ->select('e.idempleado','p.identificacion','pd.idpdeudas','pd.acreedor','pd.amortizacionmensual','pd.montodeuda','pd.motivodeuda')
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

        public function listarcredito1(Request $request, $id)
        {
            $deuda = DB::table('personadeudas as pd')
            ->select('pd.idpdeudas','pd.acreedor','pd.amortizacionmensual','pd.montodeuda','pd.motivodeuda')
            ->where('pd.idpdeudas','=',$id)
            ->first();
            return response()->json($deuda);
        }

        public function agregarcredito(Request $request)
        {
            $this->validateRequestC($request);
            $familia = new Deudas;
            $familia-> acreedor = $request->get('acreedor');
            $familia-> amortizacionmensual = $request->get('amortizacionmensual');
            $familia-> montodeuda = $request->get('montodeuda');
            $familia-> motivodeuda = $request->get('mdeuda');
            $familia-> idempleado = $request->get('idempleado');
            $familia-> identificacion = $request->get('identificacion');

            $familia->save();

            return response()->json($familia);
        }

        public function updateco (Request $request, $id)
        {
            $cre = Deudas::findOrFail($id);
            $cre-> acreedor = $request->get('acreedor');
            $cre-> amortizacionmensual = $request->get('amortizacionmensual');
            $cre-> montodeuda = $request->get('montodeuda');
            $cre-> motivodeuda = $request->get('mdeuda');
            $cre->save();

            return response()->json($cre);
        }

        public function deletecredito ($id)
        {
            $cre =  Deudas::findOrFail($id); 
                    Deudas::destroy($id);
            return response()->json($cre);
        }
    //Datos padecimientos
        public function listarpadecimiento(Request $request)
        {
            $padecimiento = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('users as u','p.identificacion','=','u.identificacion')
            ->join('personapadecimientos as pp','e.identificacion','=','pp.identificacion')
            ->select('e.idempleado','p.identificacion','pp.nombre','pp.idppadecimientos')
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

        public function listarpadecimiento1(Request $request,$id )
        {
            $padecimiento = DB::table('personapadecimientos as pp')
            ->select('pp.nombre','pp.idppadecimientos')
            ->where('pp.idppadecimientos','=',$id)
            ->first();
            return response()->json($padecimiento);
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

        public function updatepad(Request $request, $id)
        {
            $pad= Padecimientos::findOrFail($id);
            $pad-> nombre=$request->get('nombre');
            $pad->save();
            return response()->json($pad);
        }
        public function deletepad ($id)
        {
            $cre =  Padecimientos::findOrFail($id); 
                    Padecimientos::destroy($id);
            return response()->json($cre);
        }
    //Datos experiencia
        public function listarexperiencia(Request $request)
        {
            $experiencia = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('users as u','p.identificacion','=','u.identificacion')
            ->join('personaexperiencia as pe','e.identificacion','=','pe.identificacion')
            ->select('e.idempleado','p.identificacion','pe.idpexperiencia','pe.empresa','pe.puesto','pe.jefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex')
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

        public function listarexperiencia1(Request $request, $id)
        {
            $experiencia = DB::table('personaexperiencia as pe')
            ->select('pe.idpexperiencia','pe.empresa','pe.puesto','pe.jefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex')
            ->where('pe.idpexperiencia','=',$id)
            ->first();
            return response()->json($experiencia);
        }

        public function agregarexperiencia(Request $request)
        {
            $this->validateRequestE($request);
            $familia = new Experiencia;
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

        public function updatexp (Request $request,$id)
        {
            $ex = Experiencia::findOrFail($id);
            $ex-> empresa = $request->get('empresa');
            $ex-> puesto = $request->get('puesto');
            $ex-> jefeinmediato = $request->get('jefeinmediato');
            $ex-> motivoretiro = $request->get('motivoretiro');
            $ex-> ultimosalario = $request->get('ultimosalario');
            $ex-> fingresoex = $request->get('año_ingreso');
            $ex-> fsalidaex = $request->get('año_salida');
            $ex->save();
            return response()->json($ex);
        }

        public function deletexp ($id)
        {
            $cre =  Experiencia::findOrFail($id); 
                    Experiencia::destroy($id);
            return response()->json($cre);
        }
    //Datos otros
       public function listarotros(Request $request)
        {
            $empleado = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('users as u','p.identificacion','=','u.identificacion')
            ->select('e.idempleado','p.identificacion','e.peso','e.talla','e.altura','e.celcorporativo')
            ->where('u.id','=',Auth::user()->id)
            ->first();
            //dd($empleado);
             return view("hr.otros",["empleado"=>$empleado]);
        }

        public function listarotros1(Request $request, $id)
        {
            $empleado = DB::table('empleado as e')
            ->select('e.idempleado','e.peso','e.talla','e.altura','e.celcorporativo')
            ->where('e.idempleado','=',$id)
            ->first();
             return response()->json($empleado);
        }
        public function agregarotros(Request $request)
        {
            $this->validateRequestO($request);

            $id = $request->get('idempleado');

            $ao=Empleado::findOrFail($id);
            $ao-> celcorporativo=$request->get('celcorporativo');
            $ao-> talla=$request->get('talla');
            $ao-> peso=$request->get('peso');
            $ao-> altura=$request->get('altura');
            $ao->save();
            return response()->json($ao);
        } 
        /*public function updateotros(Request $request,$id)
        {
            $id = $request->get('idempleado');

            $ao=Empleado::findOrFail($id);
            $ao-> celcorporativo=$request->get('celcorporativo');
            $ao-> talla=$request->get('talla');
            $ao-> peso=$request->get('peso');
            $ao-> altura=$request->get('altura');
            $ao->save();
            return response()->json($ao);
        } */
    //Validaciones

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

        public function validateRequestO($request){
            $rules=[
            'celcorporativo' => 'required',
            'talla' => 'required',
            'altura' => 'required',
            'peso' => 'required',

            ];
            $messages=[
            'required' => 'Debe ingresar :attribute.',
            'max'  => 'La capacidad del campo :attribute es :max',
            ];
            $this->validate($request, $rules,$messages);        
        }
    //Fin validaciones
}
