<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViajeV extends Model
{
    protected $table='viajevehiculo';
 	protected $primaryKey='idviajevehiculo';    

    public $timestamps = false;
    
    protected $fillable =[
    	'idviaje',
        'idvehiculo',
        'kilometrajeini',
    	'kilometrajefin',
    ];
}
