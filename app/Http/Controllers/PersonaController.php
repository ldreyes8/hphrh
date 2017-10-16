<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Session\SessionManager;
use App\Http\Requests\PersonaRequest;
use App\Academico;
use App\Persona;
use App\Empleado;
use App\Deudas;
use App\Experiencia;
use App\Familia;
use App\Padecimientos;
use App\Referencia;
use App\Idioma;
use App\Licencia;
use App\PuestoPublico;
use App\Textranjero;
use App\Observacion;
Use Session;
use Storage;
use DB;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Validator;
use Mail;

class PersonaController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    public function index (Request $request)
    {
        if ($request)
        {
        }
    }
    public function show(Request $request)
    {
        if ($request)
        {
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

    public function create(SessionManager $sessionManager)
    {
        Session::flash('message','Use Navegador Chrome o Firefox para llenar este formulario');
        //$sessionManager->flash('mensaje', 'Llene este formulario en Navegador Chorme');

        $departamento=DB::table('departamento')->get();
        $estadocivil=DB::table('estadocivil')->get();
        $puestos=DB::table('puesto as p')
        ->where('p.statusp','=','2')
        ->orderBy('p.nombre','asc')
        ->get();
        $afiliados=DB::table('afiliado as a')
        ->where('a.statusa','=','2')
        ->orderBy('a.nombre','asc')
        ->get();
        $idiomas = DB::table('idioma')->get();
        $licencia = DB::table('licencia')->get();
        $etnia = DB::table('etnia')->get();
        $nacionalidad = DB::table('nacionalidad')->get();
        $tdocumento = DB::table('documento')->get();
        $nivelacademico = DB::table('nivelacademico')->get();
        $pais=DB::table('pais')->get();
        //return view("solicitud1",["departamento"=>$departamento,"estadocivil"=>$estadocivil,"idiomas"=>$idiomas,"puestos"=>$puestos,"afiliados"=>$afiliados,"licencia"=>$licencia,"etnia"=>$etnia,"nacionalidad"=>$nacionalidad,"tdocumento"=>$tdocumento,"nivelacademico"=>$nivelacademico,'pais'=>$pais]);

        return view("solicitud",["departamento"=>$departamento,"estadocivil"=>$estadocivil,"idiomas"=>$idiomas,"puestos"=>$puestos,"afiliados"=>$afiliados,"licencia"=>$licencia,"etnia"=>$etnia,"nacionalidad"=>$nacionalidad,"tdocumento"=>$tdocumento,"nivelacademico"=>$nivelacademico,'pais'=>$pais]);
    }
    public function verifica(Request $request,$id)
    {
        $persona=DB::table('persona as p')
        ->select('p.identificacion','p.nombre1')
        ->where('p.identificacion','=',$id)
        ->first();
        if ($persona->identificacion==$id) {
            return response()->json($persona);
        }
        else{return response()->json('Continuar');}
        
    }
    public function store(Request $request)
    {   
        try {
            DB::beginTransaction();
                $this->Personavalid($request);
                $identificacion=$request->get('identificacion');
                $img=$request->file('archivo');
                $trabE=$request->get('trabajoext');
                $envcorreo=$request->get('correo');
                $ived=$request->get('ive');
                $pariente=$request->get('parientepolitico');
                $paisP = $request->get('idpaisPS');
                /*itmes*/
                    $miArrayTE = $request->itemsTE;
                    $miArrayPF = $request->itemsPF;
                    $miArrayPA = $request->itemsPA;
                    $miArrayPI = $request->itemsPI;
                    $miArrayPL = $request->itemsPL;
                    $miArrayPR = $request->itemsPR;
                    $miArrayPP = $request->itemsPP;
                    $miArrayPC = $request->itemsPC;
                    $miArrayPD = $request->itemsPD;
                /*fin items*/
                //Datos persona
                    $persona = new Persona;
                    $persona-> identificacion = $identificacion;
                    $persona-> nombre1 = $request->get('nombre1');
                    $persona-> nombre2 = $request->get('nombre2');
                    $persona-> nombre3 = $request->get('nombre3');
                    $persona-> apellido1 = $request->get('apellido1');
                    $persona-> apellido2 = $request->get('apellido2');
                    $persona-> apellido3 = $request->get('apellido3');
                    $persona-> telefono = $request->get('telefono');
                    $persona-> celular = $request->get('celular');
                    $fechanacs=$request->get('fechanac');
                    $fechanacc=Carbon::createFromFormat('d/m/Y',$fechanacs);
                    $fecha=$fechanacc->format('Y-m-d');
                    $persona-> fechanac = $fecha;
                    $persona-> barriocolonia = $request->get('barriocolonia');
                    if ($paisP === "73") 
                    {
                        $persona-> idmunicipio = $request->get('idmunicipio');
                    }
                    else
                    {
                        $persona-> idmunicipio =NULL;
                    }
                    $persona-> ive = $ived;
                    $persona-> parientepolitico = $pariente;
                    $persona-> idpuesto= $request->get('idpuesto');
                    $persona-> idafiliado= $request->get('idafiliado');
                    if($img === null)
                    {
                        $persona->finiquitoive="";
                    }
                    else
                    {
                        $file_route=time().'_'.$img->getClientOriginalName();
                        Storage::disk('archivos')->put($file_route, file_get_contents($img->getRealPath() ) );
                        $persona-> finiquitoive=$file_route;    
                    }
                    $persona-> correo=$envcorreo;
                    $persona-> genero=$request->get('genero');
                    $persona-> idetnia=$request->get('idetnia');
                    $persona-> idnacionalidad=$request->get('idnacionalidad');
                    $persona-> iddocumento=$request->get('iddocumento');
                    $persona-> idpais=$paisP;
                    $persona->save();
                //Datos empleado
                    $empleado = new Empleado;
                    $empleado-> identificacion= $request->get('identificacion');
                    $empleado-> afiliacionigss= $request->get('afiliacionigss');
                    $empleado-> numerodependientes= $request->get('numerodependientes');
                    $empleado-> aportemensual= $request->get('aportemensual');
                    $empleado-> vivienda= $request->get('vivienda');
                    $empleado-> alquilermensual= $request->get('alquilermensual');
                    $empleado-> otrosingresos= $request->get('otrosingresos');
                    $empleado-> pretension= $request->get('pretension');
                    $empleado-> nit= $request->get('nit');
                    $mytime = Carbon::now('America/Guatemala');
                    $empleado-> fechasolicitud=$mytime->toDateTimeString();
                    $empleado-> idcivil= $request->get('idcivil');
                    $empleado-> idstatus='1';
                    $empleado-> save();
                //Datos Puesto Publico
                    if ($pariente === 'No') 
                    {
                        $ppublico= new PuestoPublico;
                        $ppublico-> nombre="";
                    }
                    else
                    {
                        $ppublico= new PuestoPublico;
                        $ppublico-> nombre=$request->get('nombrep');
                        $ppublico-> puesto=$request->get('puestop');
                        $ppublico-> dependencia=$request->get('dependencia');
                        $ppublico-> identificacion= $request->get('identificacion');
                        $ppublico-> save();
                    }
                //Datos trabajo extranjer
                    if ($trabE === "No" ) 
                    {   
                        $ptextra=new Textranjero;
                        $ptextra-> idpais=NULL;
                        $ptextra-> identificacion=$request->get('identificacion');
                        $ptextra-> trabajoext=$trabE; 
                        $ptextra-> forma="";
                        $ptextra-> motivofin="";
                        $ptextra->save();  
                    }
                    else 
                    {
                        foreach ($miArrayTE as $key => $value) {
                            $ptextra=new Textranjero;
                            $ptextra-> forma=$value['0'];
                            $ptextra-> idpais=$value['1'];
                            $ptextra-> motivofin=$value['2'];
                            $ptextra-> identificacion=$identificacion;
                            $ptextra-> trabajoext=$trabE;
                            $ptextra->save();
                        }   
                    }
                //Familia
                    if ($miArrayPF > 0)
                    {
                        foreach ($miArrayPF as $key => $value) {
                            $familia = new Familia;
                            $familia-> nombref = $value['0'];
                            $familia-> apellidof = $value['1'];
                            $familia-> edad = $value['2'];
                            $familia-> telefonof = $value['3'];
                            $familia-> parentezco = $value['4'];
                            $familia-> ocupacion = $value['5']; 
                            $familia-> emergencia = $value['6'];
                            $familia-> idempleado = $empleado->idempleado;
                            $familia-> identificacion = $identificacion;
                            $familia->save();
                        }      
                    }
                    else
                    {
                        $familia = new Familia;
                        $familia->nombref="El usuario no ingreso datos";
                        $familia-> idempleado = $empleado->idempleado;
                        $familia-> identificacion = $empleado->identificacion;
                        $familia->save();
                    }
                //Academico
                    if ($miArrayPA > 0)
                    {
                        foreach ($miArrayPA as $key => $value)
                        {   
                            $value['5']=Carbon::createFromFormat('d/m/Y',$value['5']);
                            $value['5']=$value['5']->format('Y-m-d');
                            $value['6']=Carbon::createFromFormat('d/m/Y',$value['6']);
                            $value['6']=$value['6']->format('Y-m-d');

                            $academicos = new Academico;
                            $academicos-> titulo = $value['0'];
                            $academicos-> establecimiento = $value['1'];
                            $academicos-> duracion = $value['2'];
                            $academicos-> periodo =$value['3'];
                            $academicos-> idnivel = $value['4'];
                            $academicos-> fingreso =$value['5'];
                            $academicos-> fsalida=$value['6'];
                            if ($value['8'] ==="73") 
                            {
                                $academicos-> idmunicipio = $value['7'];
                                $academicos-> idpais = $value['8'];
                            }
                            else
                            {
                                $academicos-> idpais = $value['8'];
                            }
                                    
                            $academicos-> idempleado = $empleado->idempleado;
                            $academicos-> identificacion = $empleado->identificacion;
                            $academicos-> save();
                        } 
                    }
                    else 
                    {
                        $academicos = new Academico;
                        $academicos-> titulo = "El usuario no ingreso datos";
                    }
                //Idioma
                    if ($miArrayPI > 0)
                    {
                        foreach ($miArrayPI as $key => $value) {
                            $idioma = new Idioma;
                            $idioma-> ididioma = $value['0'];
                            $idioma-> nivel = $value['1'];
                            $idioma-> idempleado = $empleado->idempleado;
                            $idioma->save();
                        }
                    }
                    else 
                    {
                        $idioma = new Idioma;
                        $idioma-> nivel = "";
                    }
                //Experiencia
                    if ($miArrayPL >0) 
                    {
                        foreach ($miArrayPL as $key => $value) {
                            $experiencia = new Experiencia;
                            $experiencia-> empresa=$value['0'];
                            $experiencia-> puesto=$value['1'];
                            $experiencia-> jefeinmediato=$value['2'];
                            $experiencia-> teljefeinmediato=$value['3'];
                            $experiencia-> motivoretiro=$value['4'];
                            $experiencia-> ultimosalario=$value['5'];
                            $experiencia-> fingresoex=$value['6'];
                            $experiencia-> fsalidaex=$value['7'];
                            $experiencia-> idempleado=$empleado->idempleado;
                            $experiencia-> identificacion=$empleado->identificacion; 
                            $experiencia->save();
                        }
                    }
                    else 
                    {
                        $experiencia = new Experiencia;
                        $experiencia-> empresa="El usuario no presenta experiencia laboral";
                        $experiencia-> idempleado=$empleado->idempleado;
                        $experiencia-> identificacion=$empleado->identificacion; 
                        $experiencia->save();    
                    }
                //Referencia
                    if ($miArrayPR > 0) 
                    {
                        foreach ($miArrayPR as $key => $value) {
                            $referencia = new Referencia;
                            $referencia-> nombrer=$value['0'];
                            $referencia-> telefonor=$value['1'];
                            $referencia-> profesion=$value['2'];
                            $referencia-> tiporeferencia=$value['3'];
                            $referencia-> idempleado=$empleado->idempleado;
                            $referencia-> identificacion=$empleado->identificacion; 
                            $referencia->save();
                        }
                    }
                    else 
                    {
                        $referencia = new Referencia;
                        $referencia-> nombrer="El usuario no ingreso datos";
                        $referencia-> idempleado=$empleado->idempleado;
                        $referencia-> identificacion=$empleado->identificacion; 
                        $referencia->save();
                    }
                //Padecimientos
                    if ($miArrayPP >0) 
                    {
                        foreach ($miArrayPP as $key => $value) {
                            $padecimiento= new Padecimientos;
                            $padecimiento-> nombre = $value['0'];
                            $padecimiento-> idempleado = $empleado->idempleado;
                            $padecimiento-> identificacion = $empleado->identificacion;
                            $padecimiento->save();
                        }
                    }
                    else 
                    {
                        $padecimiento= new Padecimientos;
                        $padecimiento-> nombre = " ";
                    }
                //Licencia
                    if ($miArrayPC > 0)
                    {
                        foreach ($miArrayPC as $key => $value) 
                        {
                            $licencias = new Licencia;
                            $licencias-> idlicencia = $value['0'];
                            $licencias-> vigencia = $value['1'];
                            $licencias-> identificacion = $empleado->identificacion;
                            $licencias->save();
                        }
                            
                    }
                    else 
                    {
                        $licencias = new Licencia;
                        $licencias-> vigencia = "";
                    }
                //Deudas
                    if ($miArrayPD > 0) 
                    {
                        foreach ($miArrayPD as $key => $value)
                        {
                            $deuda = new Deudas;
                            $deuda-> acreedor=$value['0'];
                            $deuda-> amortizacionmensual=$value['1'];
                            $deuda-> montodeuda=$value['2'];
                            $deuda-> motivodeuda=$value['3'];
                            $deuda-> idempleado=$empleado->idempleado;
                            $deuda-> identificacion=$empleado->identificacion;
                            $deuda->save();
                        }   
                    }
                    else 
                    {
                        $deuda = new Deudas;
                        $deuda-> acreedor="";
                    }
                //mail
                    /*Mail::send('emails.envsolicitud', function($msj){
                    $calculo = array($envcorreo);
                    Mail::send('emails.envsolicitud',['calculo' => $calculo], function($msj) use ($request){
                        $msj->subject('Solicitud de empleo');
                            //dd($persona-> correo);
                        $msj->to($request->get('correo'));
                    });*/
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return response()->json($persona);
    }

    public function upsolicitudPE(Request $request)
    {
        $idper=$request->get('identificacionup');
        $idempleado=$request->get('idempleado');
        $miArray = $request->items;
        $miArrayR = $request->itemsR;
        $miArrayF = $request->itemsF;
        $miArrayE = $request->itemsE;
        $miArrayD = $request->itemsD;
        $miArrayA = $request->itemsA;

        $persona = Persona::findOrFail($idper);
        $persona-> nombre1 = $request->get('nombre1');
        $persona-> nombre2 = $request->get('nombre2');
        $persona-> apellido1 = $request->get('apellido1');
        $persona-> apellido2 = $request->get('apellido2');
        $persona-> telefono = $request->get('telefono');
        $fechanacs=$request->get('fechanac');
        $fechanacc=Carbon::createFromFormat('d-m-Y',$fechanacs);
        $fecha=$fechanacc->format('Y-m-d');
        $persona-> fechanac = $fecha;             
        $persona-> barriocolonia = $request->get('barriocolonia');
        $persona->save();

        $empleado = Empleado::findOrFail($idempleado);
        $empleado-> afiliacionigss= $request->get('iggs');
        $empleado-> numerodependientes= $request->get('dependientes');
        $empleado-> aportemensual= $request->get('aportemensual');
        $empleado-> vivienda= $request->get('vivienda');
        $empleado-> alquilermensual= $request->get('alquilermensual');
        $empleado-> otrosingresos= $request->get('otrosingresos');
        $empleado-> nit= $request->get('nit');
        $empleado-> idcivil= $request->get('selectpicker1');
        $empleado-> save();

        if ($miArray > 0) {
            foreach ($miArray as $key => $value) {
                $padecimiento= Padecimientos::findOrFail($value['0']);
                $padecimiento-> nombre = $value['1'];
                $padecimiento->save();
            }
        }

        if ($miArrayR > 0) {
            foreach ($miArrayR as $key => $value) {
                $referencia = Referencia::findOrFail($value['0']);
                $referencia-> nombrer=$value['1'];
                $referencia-> telefonor=$value['2'];
                $referencia-> profesion=$value['3'];
                $referencia-> tiporeferencia=$value['4'];
                $referencia-> recomiendaper=$value['5'];
                $referencia-> confirmadorref=$value['6'];
                $referencia-> observacion = $value['7'];
                $referencia->save();
            }
        }
        if ($miArrayF > 0) {
            foreach ($miArrayF as $key => $value) {
                $familia = Familia::findOrFail($value['0']);
                $familia-> nombref = $value['1'];
                $familia-> parentezco = $value['2'];
                $familia-> telefonof = $value['3'];
                $familia-> ocupacion = $value['4'];
                //$familia-> apellidof = $apellidof;
                $familia-> edad = $value['5'];            
                $familia->save();
            }
        }
        if ($miArrayE > 0) {
            foreach ($miArrayE as $key => $value) {
                $experiencia = Experiencia::findOrFail($value['0']);
                $experiencia-> empresa=$value['1'];
                $experiencia-> puesto=$value['2'];
                $experiencia-> jefeinmediato=$value['3'];
                $experiencia-> teljefeinmediato=$value['4'];
                $experiencia-> motivoretiro=$value['5'];
                $experiencia-> ultimosalario=$value['6'];
                $experiencia-> fingresoex=$value['7'];
                $experiencia-> fsalidaex=$value['8'];
                $experiencia-> recomiendaexp=$value['9'];
                $experiencia-> confirmadorexp=$value['10'];
                $experiencia-> observacion = $value['11'];
                $experiencia->save();
            }
        }
        if ($miArrayD > 0) {
            foreach ($miArrayD as $key => $value) {
                $deuda = Deudas::findOrFail($value['0']);
                $deuda-> acreedor=$value['1'];
                $deuda-> amortizacionmensual=$value['2'];
                $deuda-> montodeuda=$value['3'];
                $deuda-> motivodeuda=$value['4'];
                $deuda->save();
            }
        }
        if ($miArrayA > 0) {
            foreach ($miArrayA as $key => $value) {
                $academicos = Academico::findOrFail($value['0']);
                $academicos-> titulo = $value['1'];
                $academicos-> establecimiento = $value['2'];
                $academicos-> duracion = $value['3'];
                $academicos-> idnivel = $value['4'];
                $academicos-> fingreso =$value['5'];
                $academicos-> fsalida=$value['6'];
                $academicos-> save();
            }
        }
        return response()->json($persona);
    }

    public function refcomentario(Request $request)
    {
        $this->validateRequestOb($request);
        $idper=$request->get('identificacion');
        $observacionG = $request->get('observacion');
        $idobservacionGR = $request->get('referenciaid');

        $obs= new observacion;
        $obs-> descripcion=$observacionG;
        $obs-> identificacion=$idper;
        $obs-> obreferencia=$idobservacionGR;
        $obs->save();

        return response()->json($obs);
    }
    public function expcomentaro(Request $request)
    {
        $this->validateRequestObE($request);
        $idper=$request->get('identificacion');
        $observacionGE = $request->get('observacion');
        $idpexperienciaGE = $request->get('explaboral');

        $obs= new observacion;
        $obs-> descripcion=$observacionGE;
        $obs-> identificacion=$idper;
        $obs-> obexperiencia=$idpexperienciaGE;
        $obs->save();
        return response()->json($obs);
    }
    public function entreob(Request $request)
    {
        $this->validateRequestObE($request);
        $idper=$request->get('identificacion');
        $observacionGE = $request->get('observacion');
        $identrevista = $request->get('identrevista');

        $obs= new observacion;
        $obs-> descripcion=$observacionGE;
        $obs-> identificacion=$idper;
        $obs-> identrevista=$identrevista;
        $obs->save();
        return response()->json($obs);
    }
    public function validateRequestOb($request){
            $rules=[
            'observacion' => 'required|max:300',

            ];
            $messages=[
            'required' => 'Debe ingresar :attribute.',
            'max'  => 'La capacidad del campo :attribute es :max',
            ];
            $this->validate($request, $rules,$messages);        
        }
    public function validateRequestObE($request){
            $rules=[
            'observacion' => 'required|max:300',

            ];
            $messages=[
            'required' => 'Debe ingresar :attribute.',
            'max'  => 'La capacidad del campo :attribute es :max',
            ];
            $this->validate($request, $rules,$messages);        
        }
    public function Personavalid($request){
            $rules=[
            'idpaisPS' => 'required',
            'identificacion' => 'required',
            'nombre1' => 'required',
            'apellido1' => 'required',
            'celular' => 'required',
            'fechanac' => 'required',
            'barriocolonia' => 'required',
            'pretension' => 'required',
            'idpuesto' => 'required',
            'validacion' => 'required|recaptcha',

            ];
            $messages=[
            'idpaisPS.required' => 'En datos generales, debe seleccionar su país de origen',
            'identificacion.required' => 'Debe ingresar su Identificacion.',
            'nombre1.required' => 'Almenos debe ingesar su primer nombre',
            'apellido1.required' => 'Almenos debe ingresar su primer apellido',
            'celular.required' => 'Su numero de celular es un campo obligatorio',
            'fechanac.required' => 'Debe ingresar su fecha de nacimiento',
            'barriocolonia.required' => 'Por favor ingrese su dirección',
            'pretension.required' => 'Debe ingresar su pretensión salarial',
            'idpuesto.required' => 'Debe seleccionar un puesto al que desee aplicar',
            'validacion.required'=>'Aún le falta seleccionar el campo No Soy un Robot para terminar',
            ];
            $this->validate($request, $rules,$messages);        
        }
}
