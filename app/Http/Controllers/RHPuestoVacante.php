<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;	
use App\Vacante;
use Illuminate\Support\Facades\Auth; 

class RHPuestoVacante extends Controller
{
	public function index()
	{
		return view('rrhh.puestosolicitado.index');
	}

	public function vacante()
	{
		$puesto = DB::table('vacante as vac')
		->join('afiliado as afi','vac.idafiliado','=','afi.idafiliado')
		->join('puesto as pue','vac.idpuesto','=','pue.idpuesto')
		->join('users as U','vac.idusuario','=','U.id')
		->join('persona as per','U.identificacion','=','per.identificacion')
		->select('vac.idvacante','vac.fecha','afi.idafiliado','afi.nombre as afiliado','pue.idpuesto','pue.nombre as puesto','per.nombre1','per.nombre2','per.apellido1','per.apellido2')
		->where('vac.status','=','solicitado')
		->paginate(15);

		return view('rrhh.puestosolicitado.puestosolicitado',["puesto"=>$puesto]);
	}

	public function plazaautorizada()
	{
		$puesto = DB::table('vacante as vac')
		->join('afiliado as afi','vac.idafiliado','=','afi.idafiliado')
		->join('puesto as pue','vac.idpuesto','=','pue.idpuesto')
		->join('users as U','vac.idusuario','=','U.id')
		->join('persona as per','U.identificacion','=','per.identificacion')
		->select('vac.idvacante','vac.fecha','afi.idafiliado','afi.nombre as afiliado','pue.idpuesto','pue.nombre as puesto','per.nombre1','per.nombre2','per.apellido1','per.apellido2')
		->where('vac.status','=','Autorizado')
		->paginate(15);

		return view('rrhh.puestosolicitado.indexautorizadas',["puesto"=>$puesto]);
	}   

	public function add(){

	} 

	public function update(Request $request){

		$idvacante = $request->get('idvacante');
		$valor = $request->get('valor');
		$status = $request->get('status');
		$vacante = Vacante::findOrFail($idvacante);
		$vacante->status= $status;
		$vacante->idautorizacion = Auth::user()->id;
		$vacante->update();

		if($status === "Rechazado")
		{
			$vacante->delete();
		}

		if($valor == 2)
		{
			$datos = DB::table("vacante as vac")
			->select('vac.idafiliado','idpuesto')
			->where('vac.idvacante','=',$idvacante)
			->first();

			$vacante->delete();
			//$pa = puesto afiliado
			$pa =DB::select("call deshabilitarvacante(?,?)",array($datos->idafiliado,$datos->idpuesto));
		}

		return json_encode($vacante);		
	}
}
/*begin
        set @filas = 0;
        
        select per.identificacion  
        into @filas 
        from users as U
        join persona as per on U.identificacion = per.identificacion
        where U.id = new.idusuario;
        
		insert into bitacoravacante (idpuesto,idafiliado,status,idpersona,idusuario,fechasol)
        values(new.idpuesto,new.idafiliado,new.status,@filas, user(),now());
	end*/