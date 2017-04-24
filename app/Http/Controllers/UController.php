<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UFormRequest;
use App\Empleado;
use App\Persona;
use App\User;  
use DB;


use App\Academico;
use Illuminate\Http\File;

use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

	public function galeria()
	{
		$users = User::all();
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



        //dd($user);
        //dd($fotoperfil);
        /*
    	if(Input::hasFile($fotoperfil))
        {
    	$file=Input::file($fotoperfil);
        $file->move(public_path().'/assets/imagenes/users/',$file->getClientOriginalName());
        $user->fotoperfil=$file->getClientOriginalName();
         return response()->json($fotoperfil);
        }*/

        //$user->fotoperfil = $request->fotoperfil;
       
       
         //dd($user);
        
        //$articulo->save();
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
        $academico = academico::all();
        $departamento=DB::table('departamento')->get();
        $nivelacademico = DB::table('nivelacademico')->get();
        /*
        $data =  array("users"=>$users);
        return json_encode($data);*/
        return view("hr.academico",["academico"=>$academico,"departamento"=>$departamento,"nivelacademico"=>$nivelacademico]);
        
    }


    public function listarpersonal()
    {
    	
    }

    public function academicocreate()
    {
        //return view("seguridad.usuario.create",["personas"=>$personas,"articulos"=>$articulos]);
        //$empleados=DB::table('persona')->where('tipo_persona','=','empleado')->get();
        //return view("seguridad.usuario.create",["empleados"=>$empleados]);
        
        return view("hr.academico",["departamento"=>$departamento]);
    }
   
}
