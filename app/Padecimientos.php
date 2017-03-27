<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padecimientos extends Model
{
    //
    protected $table='personapadecimientos';
    protected $primarykey='idppadecimientos';

    public $timestamps=false;

    protected $fillable=[
    	'nombre',
    	'idempleado',
    	'identificacion'
    ];

}
