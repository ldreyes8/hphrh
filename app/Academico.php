<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academico extends Model
{
    //
    protected $table='personaacademico';
    protected $primarykey='idpacademico';

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
    ];

}
