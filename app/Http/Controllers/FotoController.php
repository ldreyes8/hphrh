<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\Http\Controllers\Controller;
use App\Http\Requests\UFormRequest;
use Illuminate\Support\Collection;
use App\User;
use App\Academico;
use Illuminate\Http\File;
use DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class FotoController extends Controller
{
    public function subirimagen(Request $request)
    {
        $id=$request->input('idusuario');
        $user =User::findOrFail($id);
      	
    	$fotoperfil = $request->file('fotoperfil');
        
        $input  = array('image' => $fotoperfil) ;
        $reglas = array('image' => 'required|image|mimes:jpeg,jpg,png|max:1024');
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

    public function listaracademico()
    {
        $academico = academico::all();
        /*
        $data =  array("users"=>$users);
        return json_encode($data);*/
        return view("hr.academico",["academico"=>$academico]);
        
    }

}
