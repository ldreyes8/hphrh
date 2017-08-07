<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DateTime;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Persona;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;

use App\Constants;
use App\Vacaciones;

class Controllermintrab extends Controller
{
    //
    public function index()
    {
        /*$municipio=DB::table('persona as p')
        ->join('municipio as m','p.idmunicipio','=','m.idmunicipio')
        ->select('m.idmunicipio')
        ->get();

        if (empty($municipio->idmunicipio)) {
          $persona=DB::table('persona as p')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            ->join('nacionalidad as nac','p.idnacionalidad','=','nac.idnacionalidad')
            ->join('estadocivil as ec','em.idcivil','=','ec.idcivil')
            ->join('documento as do','do.iddocumento','=','p.iddocumento')
            ->join('etnia as ena','p.idetnia','=','ena.idetnia')
            ->select('em.idempleado','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','nac.nombre as nnac','ec.idcivil','p.identificacion','do.codmintrab as mtdo','em.nit','em.afiliacionigss as iggs','p.genero','p.fechanac','ena.idetnia')
            ->orderBy('em.idempleado','asc')
            ->get();
        }
        else
        {*/ 
        	$persona=DB::table('persona as p')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            ->join('nacionalidad as nac','p.idnacionalidad','=','nac.idnacionalidad')
            ->join('estadocivil as ec','em.idcivil','=','ec.idcivil')
            ->join('documento as do','do.iddocumento','=','p.iddocumento')
            ->join('municipio as mun','p.idmunicipio','=','mun.idmunicipio')
            ->join('departamento as dpt','mun.iddepartamento','=','dpt.iddepartamento')
            ->join('pais as ps','dpt.idpais','=','ps.idpais')
            ->join('etnia as ena','p.idetnia','=','ena.idetnia')
            ->join('status as st','em.idstatus','=','st.idstatus')
            ->select('em.idempleado','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','nac.nombre as nnac','ec.idcivil','p.identificacion','do.codmintrab as mtdo','ps.codmintrab as mtps','mun.mintrab as mtmun','em.nit','em.afiliacionigss as iggs','p.genero','p.fechanac','ena.idetnia')
            ->where('em.idstatus','=',2)
            ->orwhere('em.idstatus','=',5)

            ->orderBy('em.idempleado','asc')
            ->get();

        $hijo=DB::table('persona as p')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->select(DB::raw('count(pf.parentezco) as hijos'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hijo')
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();

        $trabajoextranjero=DB::table('persona as p')
        ->join('trabajoextranjero as te','p.identificacion','=','te.identificacion')
        ->join('pais as ps','te.idpais','=','ps.idpais')
        ->select('ps.nombre as npais','te.identificacion','te.trabajoext','te.forma','te.motivofin')
        ->get();

        $idioma=DB::table('empleado as em')
        ->join('persona as p','em.identificacion','=','p.identificacion')
        ->join('empleadoidioma as ei','em.idempleado','=','ei.idempleado')
        ->join('idioma as i','ei.ididioma','=','i.ididioma')
        ->select('i.ididioma','em.idempleado')
        ->get();

        /*$ntitulo=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.identificacion','=','p.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select(DB::raw('max(na.idnivel) as idnivel'),'p.identificacion')
        ->where('na.mintrabna','=',1)
        ->get();*/

        /*$academico=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.identificacion','=','p.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select('na.idnivel','p.identificacion','pa.titulo')
        ->where('na.idnivel','=',$ntitulo->idnivel)
        ->where('na.mintrabna','=',1)
        ->groupBy('p.identificacion','na.idnivel')
        ->first();*/

        $academico=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select(DB::raw('max(na.idnivel) as idnivel, pa.titulo'),'p.identificacion')
        ->where('na.mintrabna','=',1)
        ->groupBy('p.identificacion')
        ->orderBy('p.identificacion','asc')
        ->get();

        //return view('rrhh.reporte.Rmintrab',['persona'=>$persona,'hijo'=>$hijo,'trabajoextranjero'=>$trabajoextranjero,'idioma'=>$idioma,'ntitulo'=>$ntitulo]);

        $academico=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select(DB::raw('max(na.idnivel) as idnivel, pa.titulo'),'p.identificacion')
        ->where('na.mintrabna','=',1)
        ->groupBy('p.identificacion')
        ->orderBy('p.identificacion','asc')
        ->get();

        $today = Carbon::now();
        $year = $today->format('Y');

        $inicioaño = $year.'-01-01';      // se concatena el año actual con un texto determinado para obtener el incio del año actual
        $finaño = $year.'-12-31';         // se concatena el año actual con un texto determinado para obtener el fin del año actual

        $vac = new Vacaciones();
        $vac = $vac->selectQuery(Constants::VACATOMADA_GENERAL_QUERY,array('fini'=>$inicioaño,'ffin'=>$finaño));

        $sum = 0;
        $res = 0;

        if(count($vac)>0)
        {
          for($i = 0; $i < count($vac); $i++)
          {
            $dsolicitado = $vac[$i]->totaldias;
            $hsolicitado = $vac[$i]->totalhoras;
            $dnotomado =   $vac[$i]->soldias;
            $hnotomado =   $vac[$i]->solhoras;

            $hsolicitado =(int)$hsolicitado; 
            $hnotomado = (int)$hnotomado;

            $tdsolicitado =0;
            $tdnotomado = 0;

            $td =0;
            $resul =0;
            
            $dsolicitado = $dsolicitado * 8;
            $dnotomado = $dnotomado *8;

            $tdsolicitado = $dsolicitado + $hsolicitado;
            $tdnotomado = $dnotomado + $hnotomado;

            $td = $tdsolicitado - $tdnotomado;
            $td = $td/8;
            $sum += $td;
          
            if ($td - floor($td) == 0) {
              $resul = $td." Días";
            }
            else{
              $td = $td - 0.5;
              $resul = $td." ½ "."Días";
            }

            $calculo[] = array($resul, $vac[$i]->idempleado);
          }

          if ($sum - floor($sum) == 0) {
            $res = $sum." Días";
          }
          else{
            $sum = $sum - 0.5;
            $res = $sum." ½ "."Días";
          }
        }
        else{
          $calculo[] = 0;
        }
        
        $vac = Collection::make($calculo);

        $bajas = DB::table('empleado as emp')
        ->join('bajas as ba','emp.idempleado','=','ba.idempleado')
        ->select('ba.idempleado','ba.fechabaja')
        ->get();


        return view('rrhh.reporte.Rmintrab',['persona'=>$persona,'hijo'=>$hijo,'academico'=>$academico,'trabajoextranjero'=>$trabajoextranjero,'idioma'=>$idioma,'totalvacaciones'=>$vac,'bajas'=>$bajas]);
    }

    public function excel()
    {
        $persona=DB::table('persona as p')
            ->join('empleado as em','p.identificacion','=','em.identificacion')
            ->join('nacionalidad as nac','p.idnacionalidad','=','nac.idnacionalidad')
            ->join('estadocivil as ec','em.idcivil','=','ec.idcivil')
            ->join('documento as do','do.iddocumento','=','p.iddocumento')
            ->join('municipio as mun','p.idmunicipio','=','mun.idmunicipio')
            ->join('departamento as dpt','mun.iddepartamento','=','dpt.iddepartamento')
            ->join('pais as ps','dpt.idpais','=','ps.idpais')
            ->join('etnia as ena','p.idetnia','=','ena.idetnia')
            ->select('em.idempleado','p.nombre1','p.nombre2','p.nombre3','p.apellido1','p.apellido2','nac.nombre as nnac','ec.idcivil','p.identificacion','do.codmintrab as mtdo','ps.codmintrab as mtps','mun.mintrab as mtmun','em.nit','em.afiliacionigss as iggs','p.genero','p.fechanac','ena.idetnia')
            ->where('em.idstatus','=',2)
            ->orderBy('em.idempleado','asc')
            ->get();

        $hijo=DB::table('persona as p')
        ->join('personafamilia as pf','p.identificacion','=','pf.identificacion')
        ->select(DB::raw('count(pf.parentezco) as hijos'),'p.identificacion','pf.parentezco')
        ->where('pf.parentezco','=','Hijo')
        ->groupBy('p.identificacion','pf.parentezco')
        ->get();

        $trabajoextranjero=DB::table('persona as p')
        ->join('trabajoextranjero as te','p.identificacion','=','te.identificacion')
        ->join('pais as ps','te.idpais','=','ps.idpais')
        ->select('ps.nombre as npais','te.identificacion','te.trabajoext','te.forma','te.motivofin')
        ->get();

        $idioma=DB::table('empleado as em')
        ->join('persona as p','em.identificacion','=','p.identificacion')
        ->join('empleadoidioma as ei','em.idempleado','=','ei.idempleado')
        ->join('idioma as i','ei.ididioma','=','i.ididioma')
        ->select('i.ididioma','em.idempleado')
        ->get();

        /*$ntitulo=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.identificacion','=','p.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select(DB::raw('max(na.idnivel) as idnivel'),'p.identificacion')
        ->where('na.mintrabna','=',1)
        ->get();

        $academico=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('empleado as em','em.identificacion','=','p.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select('na.idnivel','p.identificacion','pa.titulo')
        ->where('na.idnivel','=',$ntitulo->idnivel)
        ->where('na.mintrabna','=',1)
        ->groupBy('p.identificacion','na.idnivel')
        ->get();*/

        $academico=DB::table('persona as p')
        ->join('personaacademico as pa','p.identificacion','=','pa.identificacion')
        ->join('nivelacademico as na','pa.idnivel','=','na.idnivel')
        ->select(DB::raw('max(na.idnivel) as idnivel, pa.titulo'),'p.identificacion')
        ->where('na.mintrabna','=',1)
        ->groupBy('p.identificacion')
        ->orderBy('p.identificacion','asc')
        ->get();

        Excel::create("Ministerio de trabajo", function ($excel) use ($persona,$hijo,$academico,$trabajoextranjero,$idioma)  
            {
                $excel->sheet("Reporte", function ($sheet) use ($persona,$hijo,$academico,$trabajoextranjero,$idioma)
                {
                    $sheet->loadView('excel',['persona'=>$persona,'hijo'=>$hijo,'academico'=>$academico,'trabajoextranjero'=>$trabajoextranjero,'idioma'=>$idioma]);
                });
            })->download('xls');
        return back();
    }
}
