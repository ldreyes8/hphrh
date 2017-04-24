<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Request\PersonaRequest;
use App\Academico;
use DB;

class AController extends Controller
{
    public function update(PersonaRequest $request, $id)
    {
        $articulo=Articulo::findOrFail($id);

        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
         $articulo->idCategoria=$request->get('idCategoria');

        if(Input::hasFile('imagen'))
        {
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }
        $articulo->update();
        return Redirect::to('almacen/articulo');

    }
}
