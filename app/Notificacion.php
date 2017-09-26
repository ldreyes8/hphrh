<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table='notificacion';
    protected $primaryKey='idnotificacion';

    public $timestamps=false;
    protected $fillable=
    [
    	'idemisor',
    	'idreceptor',
    	'tiponotificacion',
    	'estado',
        'idausencia',
        'autorizacion',
        'respuesta',
    ];
}
