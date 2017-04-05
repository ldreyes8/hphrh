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

use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;

class UController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
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
		return view("seguridad.usuario.create");
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
}
