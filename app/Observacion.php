<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    //
    protected $table='observaciones';
    protected $primaryKey='idobservacion';

    public $timestamps=false;

    protected $fillable=[
    	'descripcion',
    	'obexperiencia',
    	'obreferencia',
    	'identificacion',
    ];

}
