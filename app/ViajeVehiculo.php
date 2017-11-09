<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViajeVehiculo extends Model
{
    protected $table='viajevehiculo';
    protected $primaryKey='idviajevehiculo';

    public $timestamps=false;

    protected $fillable=[
    	'idviaje',
    	'idvehiculo',
    	'kilometrajeini',
    	'kilometrajefin',
    ];

    protected $guarder=[

    ];
}
