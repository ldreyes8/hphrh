<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\EmpleadoFormRequest;
use App\Empleado;
use App\Persona;
use App\Entrevista;
use DB;
use PDF;
use DateTime;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use Mail;
use Illuminate\Support\Facades\Auth;
use App\Constants;

class RHPrecalificado extends Controller
{

    public function precalificar($id)
    {
        $emp=DB::table('empleado as e')
        ->select('e.idstatus')
        ->where('e.idempleado','=',$id)
        ->first();
        if ($emp->idstatus==13) {

            $od=Empleado::find($id);
            $od-> idstatus = 4;
            $od->save();
        }
        if ($emp->idstatus==16) {

            $od=Empleado::find($id);
            $od-> idstatus = 17;
            $od->save();
        }
        return Redirect::to('empleado/listadoR');
    }
    /*public function precalificarjf($id)
    {
        $od=Empleado::find($id);
        $od-> idstatus = '4';
        $od->update();
        return Redirect::to('empleado/listadoR');
    }*/

    public function listadopreC (Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $empleados=DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('estadocivil as ec','e.idcivil','=','ec.idcivil')
            ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
            ->join('afiliado as af','p.idafiliado','=','af.idafiliado')
            ->join('status as s','e.idstatus','=','s.idstatus')
            ->select('e.idempleado','e.identificacion','e.nit','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','ec.estado as estadocivil','s.idstatus','s.statusemp as status','pu.nombre as puesto','af.nombre as afnombre')
            //->where('p.nombre1','LIKE','%'.$query.'%')
            //->andwhere('p.apellido1','LIKE','%'.$query.'%')
            ->where('e.idstatus','=',4)
            ->orwhere('e.idstatus','=',17)
            //->where('p.nombre1','LIKE','%'.$query.'%')
            //->orwhere('p.apellido1','LIKE','%'.$query.'%')

            ->groupBy('e.idempleado','e.identificacion','e.nit','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','ec.estado','s.statusemp','pu.nombre','af.nombre')
            ->orderBy('e.fechasolicitud','desc')
            
            ->paginate(19);
        }
        $var='3';
        return view('rrhh.precalificados.listadoPC',["empleados"=>$empleados,"searchText"=>$query,"var"=>$var]); 
    }

    public function listadopreCjf (Request $request)
    {
        $query=trim($request->get('searchText'));
        $perosna=new Persona;
        //$empleados = $perosna->selectQuery(Constants::listadoprecalificadosji,array(Auth::user()->id));
        $empleados =DB::select("call pcsolicitudpc(?)",array(Auth::user()->id));
        $var='9';
        return view('rrhh.jfreclutamiento.solicitudjfpc',["empleados"=>$empleados,"searchText"=>$query,"var"=>$var]);
    }

    public function precali ($id)
    {
        $municipio=DB::table('persona as p')
        ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
        ->select('m.idmunicipio')
        ->where('p.identificacion','=',$id)
        ->first();

        if (empty($municipio->idmunicipio)) {
            $persona=DB::table('persona as p')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
            ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
            ->join('estadocivil as ec','em.idcivil','=','ec.idcivil')
            ->select('em.idempleado','p.identificacion','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.telefono','p.celular','p.fechanac','p.barriocolonia','p.correo','a.nombre as afiliado','pu.nombre as puesto','p.finiquitoive','ec.estado as ecivil','ec.idcivil','em.vivienda')
            ->where('em.idempleado','=',$id)
            ->first();
        }
        else
        {    
            $persona=DB::table('persona as p')
            ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
            ->join('departamento as dp','m.iddepartamento','=','dp.iddepartamento')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
            ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
            ->join('estadocivil as ec','em.idcivil','=','ec.idcivil')
            ->select('em.idempleado','p.identificacion','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.telefono','p.celular','p.fechanac','p.barriocolonia','p.correo','dp.nombre as departamento','m.nombre as municipio','a.nombre as afiliado','pu.nombre as puesto','p.finiquitoive','ec.estado as ecivil','ec.idcivil','em.vivienda')
            ->where('em.idempleado','=',$id)
            ->first();
        }

        $ntitulo=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.idempleado','=','pa.idempleado')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select(DB::raw('max(na.idnivel) as idnivel'),'p.identificacion')
        ->where('em.idempleado','=',$id)
        ->where('na.mintrabna','=',1)
        ->first();

        $deuda=DB::table('personadeudas as pd')
        ->join('empleado as p','pd.idempleado','=','p.idempleado')
        ->select('pd.idpdeudas','pd.acreedor','pd.amortizacionmensual as pago','pd.montodeuda','pd.motivodeuda')
        ->where('p.idempleado','=',$id)
        ->get();

        $academico=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.idempleado','=','pa.idempleado')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select('na.idnivel','p.identificacion','pa.titulo')
        ->where('na.idnivel','=',$ntitulo->idnivel)
        ->where('em.idempleado','=',$id)
        ->where('na.mintrabna','=',1)
        ->groupBy('p.identificacion','na.idnivel')
        ->first();

        $licencias=DB::table('empleado as em')
        ->join('persona as p','em.identificacion','=','p.identificacion')
        ->join('personalicencia as pl','p.identificacion','=','pl.identificacion')
        ->join('licencia as l','pl.idlicencia','=','l.idlicencia')
        ->select('pl.vigencia','l.tipolicencia')
        ->where('em.idempleado','=',$id)
        ->get();

        $hermanos=DB::table('persona as p')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->join('empleado as emp','emp.idempleado','pf.idempleado')
        ->select(DB::raw('count(pf.parentezco) as hermano'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hermano')
        //->where('emp.idempleado','=',$id)
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();

        $esposa=DB::table('persona as p')
        ->join('empleado as em','p.identificacion','=','em.identificacion')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->select('pf.ocupacion','pf.parentezco')
        ->where('pf.parentezco','=','Conyuge')
        ->where('em.idempleado','=',$id)
        ->first();


        $hijo=DB::table('persona as p')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->join('empleado as emp','emp.idempleado','pf.idempleado')
        ->select(DB::raw('count(pf.parentezco) as hijos'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hijo')
        //->where('emp.idempleado','=',$id)
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();

        $entre=DB::table('persona as p')
        ->join('empleado as e','e.identificacion','=','p.identificacion')
        ->join('entrevista as en','en.perentrevista','=','p.identificacion')
        ->select('en.identrevista','en.fechaentre','en.lugar','en.aportefamilia','en.cargasfamiliares','en.mcorto','en.mmediano','en.mlargo','en.descpersonal','en.trabajoequipo','en.bajopresion','en.atencionpublico','en.ordenado','en.presentacion','en.disponibilidad','en.dispoviajar','en.dispfinsemana','en.comunicar','en.pretensionminima','en.entrevistadores','en.perentrevista','en.vivecompania','en.puntual','en.dedicanpadres')
        ->where('e.idempleado','=',$id)
        ->first();

        //dd($entre);
        $date = Carbon::now('America/Guatemala');
        $date = $date->format('d-m-Y');

        $fedad = new DateTime($persona->fechanac);
        $month = $fedad->format('m');
        $day = $fedad->format('d');
        $year = $fedad->format('Y');
        $fnac = Carbon::createFromDate($year,$month,$day)->age;

        $departamento=DB::table('departamento')->get();
        $nivelacademico = DB::table('nivelacademico')->get();
        $pais=DB::table('pais')->get();
        $academicoIns = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('personaacademico as pa','e.identificacion','=','pa.identificacion')
            ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
            ->select('e.idempleado','p.identificacion','pa.idpacademico','pa.titulo','pa.establecimiento','pa.duracion','pa.fingreso','pa.fsalida','pa.idmunicipio','pa.identificacion','pa.idnivel','pa.periodo','na.nombrena')
            ->where('e.idempleado','=',$id)
            ->get();

        $experiencia = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('personaexperiencia as pe','e.identificacion','=','pe.identificacion')
            ->select('e.idempleado','p.identificacion','pe.idpexperiencia','pe.empresa','pe.puesto','pe.jefeinmediato','pe.teljefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex')
            ->where('e.idempleado','=',$id)
            ->get();

        $observaR=DB::table('persona as p')
            ->join('empleado as e','p.identificacion','=','e.identificacion')
            ->join('observaciones as ob','p.identificacion','=','ob.identificacion')
            ->join('entrevista as pr','pr.identrevista','=','ob.identrevista')
            ->select('p.identificacion','ob.descripcion','pr.identrevista')
            ->where('e.idempleado','=',$id)
            ->get();

        return view('rrhh.precalificados.precalifica',["persona"=>$persona,"date"=>$date,"fnac"=>$fnac,"academico"=>$academico,"licencias"=>$licencias,"nivelacademico"=>$nivelacademico,"academicoIns"=>$academicoIns,'pais'=>$pais,'departamento'=>$departamento,"experiencia"=>$experiencia,"hermanos"=>$hermanos,"hijo"=>$hijo,'esposa'=>$esposa,"entre"=>$entre,"observaR"=>$observaR,"deuda"=>$deuda]);
    }

    public function PDFpreC ($id)
    {
        $municipio=DB::table('persona as p')
        ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
        ->select('m.idmunicipio')
        ->where('p.identificacion','=',$id)
        ->first();

        if (empty($municipio->idmunicipio)) {
            $persona=DB::table('persona as p')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
            ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
            ->join('estadocivil as ec','em.idcivil','=','ec.idcivil')
            ->select('em.idempleado','p.identificacion','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.telefono','p.celular','p.fechanac','p.barriocolonia','p.correo','a.nombre as afiliado','pu.nombre as puesto','p.finiquitoive','ec.estado as ecivil','ec.idcivil','em.vivienda')
            ->where('em.idempleado','=',$id)
            ->first();
        }
        else
        {    
            $persona=DB::table('persona as p')
            ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
            ->join('departamento as dp','m.iddepartamento','=','dp.iddepartamento')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            ->join('afiliado as a','p.idafiliado','=','a.idafiliado')
            ->join('puesto as pu','p.idpuesto','=','pu.idpuesto')
            ->join('estadocivil as ec','em.idcivil','=','ec.idcivil')
            ->select('em.idempleado','p.identificacion','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','p.apellido3','p.telefono','p.celular','p.fechanac','p.barriocolonia','p.correo','dp.nombre as departamento','m.nombre as municipio','a.nombre as afiliado','pu.nombre as puesto','p.finiquitoive','ec.estado as ecivil','ec.idcivil','em.vivienda')
            ->where('em.idempleado','=',$id)
            ->first();
        }

        $ntitulo=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.idempleado','=','pa.idempleado')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select(DB::raw('max(na.idnivel) as idnivel'),'p.identificacion')
        ->where('em.idempleado','=',$id)
        ->where('na.mintrabna','=',1)
        ->first();


        $academico=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.idempleado','=','pa.idempleado')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select('na.idnivel','p.identificacion','pa.titulo')
        ->where('na.idnivel','=',$ntitulo->idnivel)
        ->where('na.mintrabna','=',1)
        ->first();

        $deuda=DB::table('personadeudas as pd')
        ->join('empleado as p','pd.idempleado','=','p.idempleado')
        ->select('pd.idpdeudas','pd.acreedor','pd.amortizacionmensual as pago','pd.montodeuda','pd.motivodeuda')
        ->where('p.idempleado','=',$id)
        ->get();

        $licencias=DB::table('empleado as em')
        ->join('persona as p','em.identificacion','=','p.identificacion')
        ->join('personalicencia as pl','p.identificacion','=','pl.identificacion')
        ->join('licencia as l','pl.idlicencia','=','l.idlicencia')
        ->select('l.tipolicencia')
        ->where('em.idempleado','=',$id)
        ->get();

        $hermanos=DB::table('persona as p')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->join('empleado as emp','emp.idempleado','pf.idempleado')
        ->select(DB::raw('count(pf.parentezco) as hermano'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hermano')
        //->where('emp.idempleado','=',$id)
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();

        $esposa=DB::table('persona as p')
        ->join('empleado as em','p.identificacion','=','em.identificacion')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->select('pf.ocupacion','pf.parentezco')
        ->where('pf.parentezco','=','Conyuge')
        ->where('em.idempleado','=',$id)
        ->first();


        $hijo=DB::table('persona as p')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->join('empleado as emp','emp.idempleado','pf.idempleado')
        ->select(DB::raw('count(pf.parentezco) as hijos'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hijo')
        //->where('emp.idempleado','=',$id)
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();

        $entre=DB::table('persona as p')
        ->join('empleado as e','e.identificacion','=','p.identificacion')
        ->join('entrevista as en','en.perentrevista','=','p.identificacion')
        ->select('en.identrevista','en.fechaentre','en.lugar','en.aportefamilia','en.cargasfamiliares','en.mcorto','en.mmediano','en.mlargo','en.descpersonal','en.trabajoequipo','en.bajopresion','en.atencionpublico','en.ordenado','en.presentacion','en.disponibilidad','en.dispoviajar','en.dispfinsemana','en.comunicar','en.pretensionminima','en.entrevistadores','en.perentrevista','en.vivecompania','en.puntual','en.dedicanpadres')
        ->where('e.idempleado','=',$id)
        ->first();

        //dd($entre);
        $date = Carbon::now('America/Guatemala');
        $date = $date->format('d-m-Y');

        $fedad = new DateTime($persona->fechanac);
        $month = $fedad->format('m');
        $day = $fedad->format('d');
        $year = $fedad->format('Y');
        $fnac = Carbon::createFromDate($year,$month,$day)->age;

        $departamento=DB::table('departamento')->get();
        $nivelacademico = DB::table('nivelacademico')->get();
        $pais=DB::table('pais')->get();
        $academicoIns = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('personaacademico as pa','e.identificacion','=','pa.identificacion')
            ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
            ->select('e.idempleado','p.identificacion','pa.idpacademico','pa.titulo','pa.establecimiento','pa.duracion','pa.fingreso','pa.fsalida','pa.idmunicipio','pa.identificacion','pa.idnivel','pa.periodo','na.nombrena')
            ->where('e.idempleado','=',$id)
            ->get();

        $experiencia = DB::table('empleado as e')
            ->join('persona as p','e.identificacion','=','p.identificacion')
            ->join('personaexperiencia as pe','e.identificacion','=','pe.identificacion')
            ->select('e.idempleado','p.identificacion','pe.idpexperiencia','pe.empresa','pe.puesto','pe.jefeinmediato','pe.teljefeinmediato','pe.motivoretiro','pe.ultimosalario','pe.fingresoex','pe.fsalidaex')
            ->where('e.idempleado','=',$id)
            ->get();

        $observaR=DB::table('persona as p')
            ->join('empleado as e','p.identificacion','=','e.identificacion')
            ->join('observaciones as ob','p.identificacion','=','ob.identificacion')
            ->join('entrevista as pr','pr.identrevista','=','ob.identrevista')
            ->select('p.identificacion','ob.descripcion','pr.identrevista')
            ->where('e.idempleado','=',$id)
            ->get();

        $pdf= PDF::loadView('rrhh.precalificados.pdfPreC',["persona"=>$persona,"date"=>$date,"fnac"=>$fnac,"academico"=>$academico,"licencias"=>$licencias,"nivelacademico"=>$nivelacademico,"academicoIns"=>$academicoIns,'pais'=>$pais,'departamento'=>$departamento,"experiencia"=>$experiencia,"hermanos"=>$hermanos,"hijo"=>$hijo,'esposa'=>$esposa,"entre"=>$entre,"observaR"=>$observaR,"deuda"=>$deuda]);
        return $pdf->download('Pre-Calificado.pdf'); 
    }

}
