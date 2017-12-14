<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table='proyecto';
    protected $primaryKey='idproyecto';

    public $timestamps=false;
    protected $fillable=
    [
    	'nombreproyecto',
    	'montoproyecto',
    	'descripcion',
    	'fechainicio',
    	'fechafin',
    	'status',
    	'saldoproyecto',
    	'codigoconta',
    	'indice'
    ];
}
