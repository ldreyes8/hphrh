<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacaciones extends BaseModel
{
    protected $primaryKey = 'idausencia';
    protected $table = 'ausencia';
    protected $fillable = array('fechainicio',
    	'fechafin','horainicio','horafin','totaldias','totalhoras','observaciones','descvaca','juzgadoinstitucion','tipocaso','autorizacion','idempleado','idmunicipio','idtipoausencia','concurrencia');

    public $timestamps = false;

    protected $dates = [
    	'fini',
    	'ffin'
    ];


	public function empleado(){
        return $this->hasOne('App\Empleado', 'idempleado','idempleado');     
    }

    public function Tipoausencia(){
        return $this->hasOne('App\Tausencia', 'idtipoausencia','idtipoausencia');     
    }

    public function scopeBusqueda($query,$tipoausencia,$dato="")
    {
        if($tipoausencia==0){ 
            $resultado = $query->whereHas("empleado",function($query) use ($dato)
            {
                $query->persona($dato);
            });
        }

        else{
        	$resultado = $query->where('ausencia.idtipoausencia', '=', $tipoausencia)->whereHas("empleado",function($query) use ($dato)
            {
                $query->persona($dato);
            });
        }                
        return  $resultado;
    }
   
}