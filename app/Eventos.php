<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    //
    protected $table = 'tablero';
    protected $primaryKey = 'id';

    public $timestamps=false;
    protected $fillable=
    [
    	'fechapublica',
    	'titulo',
    	'post',
    	'imagen',
    	'idempleado',
    ];
}
