<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
	protected $table='vehiculo';
 	protected $primaryKey='idvehiculo';    

    public $timestamps = false;
    
    protected $fillable =[
    	'placa',
        'color',
        'marca',
    	'modelo',
        'idvstatus',
    ];
}
