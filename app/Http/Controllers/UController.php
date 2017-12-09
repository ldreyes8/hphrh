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
use App\Observacion;
use App\Eventos;
use App\User;  
use App\Licencia;
use App\Idioma;
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

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Intervention\Image\Facades\Image as Image;

class UController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    //Datos usuario

        public function contenedor(Request $request)
        {
            return view('seguridad.usuario.contenedor');
        }
        public function index(Request $request)
        {
        	if($request)
        	{
        		//$query=trim($request->get('searchText'));
                $usuarios = User::name($request->get('name'))->orderBy('id','DESC')->paginate(15);
                $roles=Role::all();
                return view('seguridad.usuario.index',compact('usuarios','roles'));
                //$usuarios=User::all()->where('name','LIKE','%'.$query.'%')
                //->orderBy('id','desc')
                //->paginate(15);
                //$usuarios=User::paginate(15);
                //return view('seguridad.usuario.index',["usuarios"=>$usuarios,"roles"=>$roles]);
        	}
        }

        public function buscar_usuarios($rol,$dato="")
        {
            $usuarios= User::Busqueda($rol,$dato)->paginate(15);  
            $roles=Role::all();
            $rolsel=$roles->find($rol);
            return view('seguridad.usuario.index')
            ->with("usuarios", $usuarios )
            ->with("rolsel", $rolsel )
            ->with("roles", $roles );       
        }

        public function galeria()
        {
            $users=DB::table('users as U')
            ->join('persona as per','U.identificacion','=','per.identificacion')
            ->join('empleado as emp','per.identificacion','=','emp.identificacion')
            ->join('nomytras as nt','emp.idempleado','=','nt.idempleado')
            ->join('puesto as p','nt.idpuesto','=','p.idpuesto')
            ->join('afiliado as a','nt.idafiliado','=','a.idafiliado')
            ->select('U.name','U.email','emp.celcorporativo','U.fotoperfil','p.nombre as puesto','a.nombre as afiliado','emp.idempleado',DB::raw('max(nt.idnomytas) as idnomytas'))
            ->where('U.id','!=',Auth::user()->id)
            ->where('U.estado','=',1)
            ->groupBy('emp.idempleado')            
            ->paginate(30);
               
            
        		/*
        		$data =  array("users"=>$users);
        		return json_encode($data);*/
            return view("hr.galeria")->with("usuario",$users);    		
        }

            public function buscar_personal($dato){
              
                if($dato=="general")
                {
                    $users=DB::table('users as U')
                ->join('persona as per','U.identificacion','=','per.identificacion')
                ->join('empleado as emp','per.identificacion','=','emp.identificacion')
                ->join('nomytras as nt','emp.idempleado','=','nt.idempleado')
                ->join('puesto as p','nt.idpuesto','=','p.idpuesto')
                ->join('afiliado as a','nt.idafiliado','=','a.idafiliado')
                ->select('U.name','U.email','emp.celcorporativo','U.fotoperfil','p.nombre as puesto','a.nombre as afiliado','emp.idempleado')
                ->where('U.id','!=',Auth::user()->id)
                            ->where('U.estado','=',1)

                ->groupBy('emp.idempleado') 
                ->paginate(30);                 
                }
                else{

                $users=DB::table('users as U')
                ->join('persona as per','U.identificacion','=','per.identificacion')
                ->join('empleado as emp','per.identificacion','=','emp.identificacion')
                ->join('nomytras as nt','emp.idempleado','=','nt.idempleado')
                ->join('puesto as p','nt.idpuesto','=','p.idpuesto')
                ->join('afiliado as a','nt.idafiliado','=','a.idafiliado')
                ->select('U.name','U.email','emp.celcorporativo','U.fotoperfil','p.nombre as puesto','a.nombre as afiliado','emp.idempleado')
                ->where("U.name","like","%".$dato."%")
                                        ->where('U.estado','=',1)

                ->orwhere("U.email","like","%".$dato."%")
                ->orwhere("p.nombre","like","%".$dato."%")
                ->orwhere("a.nombre","like","%".$dato."%")
                ->groupBy('emp.idempleado') 


                ->paginate(30);
                
                }
                return view("hr.galeria")->with("usuario",$users);
            }
            /*
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
            } */


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

                    Storage::delete(public_path()."/fotografias/".$file);

                    $nombre_original=$fotoperfil->getClientOriginalName();
                    $extension=$fotoperfil->getClientOriginalExtension();
                    $nuevo_nombre="userimagen-".$id.".".$extension;

                    $img = Image::make($fotoperfil)->resize(350, 350);

                    $r1=Storage::disk('fotografias')->put($nuevo_nombre,   (string) $img->encode() );

                    //$r1=Storage::disk('fotografias')->put($nuevo_nombre,  \File::get($img) );

                    /*$r1 = Image::make($fotoperfil)
                    ->resize(350,350)
                    ->save(public_path('fotografias/'.$nuevo_nombre));*/
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
            $pais=DB::table('pais')->get();
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

            return view("hr.academico",["departamento"=>$departamento,"nivelacademico"=>$nivelacademico,"empleado"=>$empleado,"academico"=>$academico,'pais'=>$pais]);   
        }

        public function listaracademico1(Request $request,$id)
        {   
            $municipio=DB::table('personaacademico as pa')
            ->join('municipio as m','pa.idmunicipio','=','m.idmunicipio')
            ->select('m.idmunicipio')
            ->where('pa.idpacademico','=',$id)
            ->first();
            if (empty($municipio->idmunicipio)) 
            {
                $academico = DB::table('personaacademico as pa')
                ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
                ->join('pais as ps','pa.idpais','=','ps.idpais')
                ->select('pa.idpacademico','pa.titulo','pa.establecimiento','pa.duracion',(DB::raw('DATE_FORMAT(pa.fingreso,"%d/%m/%Y") as fingreso')),(DB::raw('DATE_FORMAT(pa.fsalida,"%d/%m/%Y") as fsalida')),'pa.idnivel','na.nombrena','pa.periodo','pa.idpais','ps.nombre as nompais')
                ->where('pa.idpacademico','=',$id)
                ->first();
            }
            else
            {
                $academico = DB::table('personaacademico as pa')
                ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
                ->join('municipio as m','pa.idmunicipio','=','m.idmunicipio')
                ->join('pais as ps','pa.idpais','=','ps.idpais')
                ->select('pa.idpacademico','pa.titulo','pa.establecimiento','pa.duracion',(DB::raw('DATE_FORMAT(pa.fingreso,"%d/%m/%Y") as fingreso')),(DB::raw('DATE_FORMAT(pa.fsalida,"%d/%m/%Y") as fsalida')),'pa.idmunicipio','pa.idnivel','m.nombre','na.nombrena','pa.periodo','pa.idpais','ps.nombre as nompais')
                ->where('pa.idpacademico','=',$id)
                ->first();
            }
        
            return response()->json($academico);
        }

        public function agregaracademico(Request $request)
        {
            $this->validateRequest($request);
            $idpais = $request->get('idpais');

            $academico = new Academico;

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

            /*$academico->idpais = $request->get('idpais');
            $academico->idmunicipio = $request->get('idmunicipio');*/

            if ($idpais ==="73") 
            {
                $academico->idpais = $idpais;
                $academico->idmunicipio = $request->get('idmunicipio');
            }
            else
            {
                   //$academicos-> idmunicipio = NULL;
                $academico->idpais = $idpais;
            }


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
            $idpais = $request->get('idpais');

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
            if ($idpais ==="73") 
            {
                $academico->idpais = $idpais;
                $academico->idmunicipio = $request->get('idmunicipio');
            }
            else
            {
                   //$academicos-> idmunicipio = NULL;
                $academico->idpais = $idpais;
            }
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
            ->select('e.idempleado','p.identificacion','pe.idpexperiencia','pe.empresa','pe.puesto','pe.jefeinmediato','pe.teljefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex')
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
            ->select('pe.idpexperiencia','pe.empresa','pe.puesto','pe.jefeinmediato','pe.teljefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex')
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
            $familia->teljefeinmediato = $request->get('teljefeinmediato');
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
            $ex-> teljefeinmediato = $request->get('teljefeinmediato');
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
            $idiomas = DB::table('idioma')->get();
            $licencia = DB::table('licencia')->get();
            $puestos=DB::table('puesto as p')
            ->where('p.statusp','=','2')
            ->orderBy('p.nombre','asc')
            ->get();
            $afiliados=DB::table('afiliado as a')
            ->where('a.statusa','=','2')
            ->orderBy('a.nombre','asc')
            ->get();
        
            $empleado = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('users as u','p.identificacion','=','u.identificacion')
            ->select('e.idempleado','p.identificacion','e.peso','e.talla','e.altura','e.celcorporativo')
            ->where('u.id','=',Auth::user()->id)
            ->first();

            $emidioma = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('users as u','p.identificacion','=','u.identificacion')
            ->join('empleadoidioma as ei','e.idempleado','=','ei.idempleado')
            ->join('idioma as i','ei.ididioma','=','i.ididioma')
            ->select('e.idempleado','p.identificacion','ei.idpidioma','ei.nivel','i.nombre as idiomash')
            ->where('u.id','=',Auth::user()->id)
            ->get();

            $emlicencia = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('users as u','p.identificacion','=','u.identificacion')
            ->join('personalicencia as pl','e.identificacion','=','pl.identificacion')
            ->join('licencia as l','pl.idlicencia','=','l.idlicencia')
            ->select('e.idempleado','p.identificacion','pl.idplicencia','pl.vigencia','l.tipolicencia')
            ->where('u.id','=',Auth::user()->id)
            ->get();

             return view("hr.otros",["empleado"=>$empleado,"idiomas"=>$idiomas,"emidioma"=>$emidioma,"emlicencia"=>$emlicencia,"licencia"=>$licencia,"puestos"=>$puestos,"afiliados"=>$afiliados]);
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
    //Creación de notícias
        public function listartablero()
        {
            $tablero = DB::table('tablero as t')
            ->join('empleado as e','t.idempleado','=','e.idempleado')
            ->select('t.id','t.titulo','t.post','t.fechapublica','t.imagen','t.idempleado')
            ->get();
            return view('eventos.eventos',["tablero"=>$tablero]);

        }

        public function cnoticia(Request $request)
        {
            /*$noticia = new Eventos;
            $noticia = titulo = $request->get('titulo');
            $noticia = post = $request->get('post');
            $noticia = imagen = $request->get('imagen');
            $noticia = fechapublica = $request->get('fechap');
            $noticia = idempleado = $request->get('idempleado');
            $noticia->save();*/
        }
    //Crear licencia
        public function listarlicencia(Request $request, $id)
        {
            $emlicencia = DB::table('personalicencia as pl')
            ->join('licencia as l','pl.idlicencia','=','l.idlicencia')
            ->select('pl.idplicencia','pl.vigencia','pl.idlicencia','l.tipolicencia')
            ->where('pl.idplicencia','=',$id)
            ->first();
             return response()->json($emlicencia);
        }
        public function agregarlicencia(Request $request)
        {
            $this->validateRequestL($request);

            $licencia = new Licencia;
            $licencia-> vigencia = $request->get('vigencia');
            $licencia-> idlicencia = $request->get('licenciaid');
            $licencia-> identificacion = $request->get('identificacion');
            $licencia->save();

            return response()->json($licencia);
        }
        public function updatelic(Request $request, $id)
        {
            $licencia= Licencia::findOrFail($id);
            $licencia-> vigencia = $request->get('vigencia');
            $licencia-> idlicencia = $request->get('licenciaid');
            $licencia->save();
            return response()->json($licencia);
        }
        public function deletelic($id)
        {
            $cre =  Licencia::findOrFail($id); 
                    Licencia::destroy($id);
            return response()->json($cre);
        } 
    //Crear Idioma
        public function listaridioma(Request $request, $id)
        {

            $idiomal = DB::table('empleadoidioma as ei')
            ->join('idioma as i','ei.ididioma','=','i.ididioma')
            ->select('ei.idpidioma','ei.nivel','ei.ididioma','i.nombre')
            ->where('ei.idpidioma','=',$id)
            ->first();
             return response()->json($idiomal);
        }
        public function agregaridioma(Request $request)
        {
            $this->validateRequestI($request);

            $idioma = new Idioma;
            $idioma-> nivel = $request->get('nivel');
            $idioma-> ididioma = $request->get('ididioma');
            $idioma-> idempleado = $request->get('idempleadoI');
            $idioma->save();

            return response()->json($idioma);
        } 

        public function updateidioma(Request $request, $id)
        {
            $idioma= Idioma::findOrFail($id);
            $idioma-> nivel = $request->get('nivel');
            $idioma-> ididioma = $request->get('ididioma');
            $idioma->save();
            return response()->json($idioma);
        }
        public function deleteidioma ($id)
        {
            $cre =  Idioma::findOrFail($id); 
                    Idioma::destroy($id);
            return response()->json($cre);
        }
    //Puesto aplicar
        public function SolicitanteI(Request $request)
        {
            $idper=$request->get('identificacion');
            $idempleado=$request->get('idempleado');

            $persona = Persona::findOrFail($idper);
            $persona-> idpuesto= $request->get('puesto');
            $persona-> idafiliado= $request->get('afiliado');
            $persona->save();

            $empleado = Empleado::findOrFail($idempleado);
            $empleado-> idstatus='12';
            $mytime = Carbon::now('America/Guatemala');
            $empleado-> fechasolicitud=$mytime->toDateTimeString();
            $empleado-> save();
            //dd($persona,$empleado);
            $personas=array($persona,$empleado);
            return response()->json($personas);
        }
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

        public function validateRequestL($request){
            $rules=[
            'vigencia' => 'required',

            ];
            $messages=[
            'required' => 'Debe ingresar :attribute.',
            'max'  => 'La capacidad del campo :attribute es :max',
            ];
            $this->validate($request, $rules,$messages);        
        }

        public function validateRequestI($request){
            $rules=[
            'nivel' => 'required',

            ];
            $messages=[
            'required' => 'Debe ingresar :attribute.',
            'max'  => 'La capacidad del campo :attribute es :max',
            ];
            $this->validate($request, $rules,$messages);        
        }
    //Fin validaciones
}
