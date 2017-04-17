<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacaciones extends Model
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
}
