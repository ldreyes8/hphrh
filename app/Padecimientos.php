<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padecimientos extends Model
{
    //
    protected $table='personapadecimientos';
    protected $primaryKey='idppadecimientos';

    public $timestamps=false;

    protected $fillable=[
    	'nombre',
    	'idempleado',
    	'identificacion'
    ];

}
