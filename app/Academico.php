<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academico extends Model
{
    //
    protected $table='personaacademico';
    protected $primaryKey='idpacademico';

    public $timestamps=false;

    protected $fillable=[
    	'titulo',
    	'establecimiento',
    	'duracion',
    	'fingreso',
    	'fsalida',
    	'adjunto',
    	'idmunicipio',
    	'idempleado',
    	'identificacion',
        'idnivel',
        'periodo',
        'idpais',
    ];

}
