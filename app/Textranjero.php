<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Textranjero extends Model
{
    //
    protected $table='trabajoextranjero';
    protected $primaryKey='idtrabajoext';

    public $timestamps=false;
    protected $fillable=
    [
    	'idpais',
	    'identificacion',
	    'trabajoext',
	    'forma',
	    'motivofin',
    ];
}
