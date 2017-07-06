<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eventos;
use App\Persona;
use App\Empleado;
use Illuminate\Http\File;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


use Carbon\Carbon;  // para poder usar la fecha y hora


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now();
        $year = $today->format('Y');
        $month = $today->format('m');
        $day = $today->format('d');
   
        $persona = DB::table('persona as per')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('per.nombre1', 'per.apellido1','U.fotoperfil')
        ->whereMonth('per.fechanac','=',$month)
        ->get();

        $cumpledia = DB::table('persona as per')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('per.nombre1', 'per.apellido1','U.fotoperfil')
        ->whereDay('per.fechanac','=',$day)
        ->whereMonth('per.fechanac','=',$month)
        ->get();

        $usuarioactual=\Auth::user();

        $cumpledia = DB::table('persona as per')
        ->join('users as U','per.identificacion','=','U.identificacion')
        ->select('per.nombre1', 'per.apellido1','U.fotoperfil')
        ->whereDay('per.fechanac','=',$day)
        ->whereMonth('per.fechanac','=',$month)
        ->get();

        $tableroini = DB::table('tablero as evento')
        ->select('evento.imagen')
        ->where('evento.home','=',1)
        ->orderBy('evento.fechapublica','desc')
        ->get();

         $tablero = DB::table('tablero as evento')
        ->select('evento.imagen','evento.post','evento.titulo')
        ->where('evento.home','=',0)
        ->get();


        return view('home',array('tablero'=>$tablero,'tableroini'=>$tableroini,'persona'=>$persona,'cumpledia'=>$cumpledia));
    }
    /*
    public function subirimagen(Request $request)
    {
        $id=$request->input('idusuario');
        $user =User::findOrFail($id);
        
        $image = $request->file('image');
        
        $input  = array('image' => $image) ;
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

            $nombre_original=$image->getClientOriginalName();
            $extension=$image->getClientOriginalExtension();
            $nuevo_nombre="userimagen-".$id.".".$extension;
            $r1=Storage::disk('tablero')->put($nuevo_nombre,  \File::get($fotoperfil) );
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
        /*
    }
    */

    
       

    public function addimage(Request $request)
    {
        $evento = new Eventos;
        if(Input::hasFile('image'))
        {
            $file=Input::file('image');

            $input  = array('image' => $image) ;
            $reglas = array('image' => 'required|image|mimes:jpeg,jpg,png|max:2000');
            $validacion = Validator::make($input,  $reglas);

            if ($validacion->fails())
            {   
              return view("mensajes.msj_rechazado")->with("msj","El archivo no es una imagen valida");
            }
            else
            {
                $file->move(public_path().'/tablero/',$file->getClientOriginalName());
                $evento->save();
                return view("mensajes.msj_correcto")->with("msj","Imagen agregada correctamente");
            }
        }
    }

    public function dgenerales(Request $request)
    {
        $usuario = DB::table('users as U')
        ->join('persona as per','U.identificacion','=','per.identificacion')
        ->join('empleado as emp','per.identificacion','=','emp.identificacion')
        ->select('emp.idempleado')
        ->where('U.id','=',Auth::user()->id)
        ->first();

        $empleado = DB::table('empleado as emp')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('estadocivil as ec','emp.idcivil','=','ec.idcivil')
        ->select('per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','per.apellido3','per.fechanac','per.barriocolonia','per.genero','emp.afiliacionigss','emp.numerodependientes','emp.aportemensual','emp.vivienda','emp.alquilermensual','emp.otrosingresos','emp.pretension','emp.nit','per.identificacion','ec.estado as estadocivil','ec.idcivil','emp.idempleado')
        ->where('emp.idempleado','=',$usuario->idempleado)  
        ->first();

        $departamento=DB::table('departamento')->get();
        $estadocivil=DB::table('estadocivil')->get();

        return view("hr.persona",["departamento"=>$departamento,"estadocivil"=>$estadocivil,"empleado"=>$empleado]);
        //return view("empleado.empleado.index")->with("departamento",$departamento,"empleado",$empleado,"estadocivil",$estadocivil);
    }

    public function listardgenerales()
    {
        $usuario = DB::table('users as U')
        ->join('persona as per','U.identificacion','=','per.identificacion')
        ->join('empleado as emp','per.identificacion','=','emp.identificacion')
        ->select('emp.idempleado')
        ->where('U.id','=',Auth::user()->id)
        ->first();

        //(DB::raw('DATE_FORMAT(pa.fingreso,"%d/%m/%Y") as fingreso'))

        $empleado = DB::table('empleado as emp')
        ->join('persona as per','emp.identificacion','=','per.identificacion')
        ->join('estadocivil as ec','emp.idcivil','=','ec.idcivil')
        ->select('per.nombre1','per.nombre2','per.nombre3','per.apellido1','per.apellido2','per.apellido3',DB::raw('DATE_FORMAT(per.fechanac, "%d/%m/%Y") as fechanac'),'per.barriocolonia','per.genero','emp.afiliacionigss','emp.numerodependientes','emp.aportemensual','emp.vivienda','emp.alquilermensual','emp.otrosingresos','emp.pretension','emp.nit','per.identificacion','ec.idcivil','ec.estado as estadocivil')
        ->where('emp.idempleado','=',$usuario->idempleado)  
        ->first();

        return response()->json($empleado);
    }

    public function updatedgenerales(Request $request, $id)
    {
        $this->validateRequest($request);

        $identificacion = $request->get('idper');

        $fechanac = $request->fechanac; 

        $empleado = Empleado::findOrFail($id);
        //afiliacionigss, numerodependientes,aportemensual,viivienda,alquilermensual,otrosingresos,nit,
        //idcivil.

        $empleado->afiliacionigss = $request->afiliacionigss;
        $empleado->numerodependientes = $request->dependientes;
        $empleado->aportemensual = $request->aportemensual;
        $empleado->vivienda =$request->vivienda;
        $empleado->alquilermensual = $request->alquilermensual;
        $empleado->otrosingresos = $request->otrosingresos;
        $empleado->nit = $request->nit;
        $empleado->idcivil = $request->estadocivil;
        $empleado->save();

        $persona = Persona::findOrFail($identificacion);

        $persona->identificacion = $request->identificacion;
        $persona->nombre1 = $request->nombre1; 
        $persona->nombre2 = $request->nombre2;
        $persona->nombre3 = $request->nombre3;

        $persona->apellido1 = $request->apellido1; 
        $persona->apellido1 = $request->apellido1;
        $persona->apellido1 = $request->apellido1;

        $persona->barriocolonia = $request->barriocolonia;

        $fechanac = Carbon::createFromFormat('d/m/Y',$fechanac);
        $fechanac = $fechanac->toDateString();

        $persona->fechanac = $fechanac;
        $persona->save();


        //$fechaingreso = Carbon::createFromFormat('d/m/Y',$fechaingreso);
        //$fechasalida = Carbon::createFromFormat('d/m/Y',$fechasalida);
        //$fechaingreso = $fechaingreso->toDateString();
        //$fechasalida = $fechasalida->toDateString();
        //$academico->titulo = $request->get('titulo');
        //$academico->establecimiento = $request->get('establecimiento');
        //$academico->duracion = $request->get('duracion');
        //$academico->fingreso = $fechaingreso;
        //$academico->fsalida = $fechasalida;

        /*
        identificacion: $("#identificacion").val(),
        nit: $("#nit").val(),
        nombre1: $("#nombre1").val(),           
        nombre2: $("#nombre2").val(),
         nombre3: $('#nombre3').val(),
                        apellido1: $('#apellido1').val(),
                        apellido2: $('#apellido2').val(),
                        apellido3: $('#apellido3').val(),

                        fechanac : $("#fechanac").val(),
                        estadocivil: $("#estadocivil").val(),
                        genero: $("#genero").val(),
                        dependientes: $("#dependientes").val(),
                        aportemensual: $("#aportemensual").val(),
                        vivienda: $("#vivienda").val(),
                        alquilermensual: $("#alquilermensual").val(),
                        otrosingresos: $("#otrosingresos").val(),
                        barriocolonia: $("#barriocolonia").val(),
        */
        return response()->json($persona);
    }

    public function validateRequest($request){
            $rules=[
            'identificacion' => 'required|max:13',
            'nombre1' => 'required|max:40',
            'apellido1'=> 'required|max:40',
          
            ];
            $messages=[
            'required' => 'Debe ingresar :attribute.',
            'max'  => 'La capacidad del campo :attribute es :max',
            ];
            $this->validate($request, $rules,$messages);        
        }

}
