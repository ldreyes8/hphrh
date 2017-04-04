<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    //
    protected $table='empleadoidioma';
    protected $primarykey='idpidioma';

    public $timestamps=false;

    protected $fillable=[
    	'idempleado',
    	'ididioma',
    	'nivel'
    ];
}
