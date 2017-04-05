<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacaciones extends Model
{
    protected $primaryKey = 'idausencia';
    protected $table = 'ausencia';
    protected $fillable = array('horainicio','horafin','totaldias','totalhoras','observaciones','descvaca','juzgadoinstitucion','tipocaso','autorizacion','idempleado','idmunicipio','idtipoausencia');

    public $timestamps = false;



    protected $dates = [
    	'fechainicio',
    	'fechafin'
    ];
}
