<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deudas extends Model
{
    //
    protected $table='personadeudas';
    protected $primaryKey='idpdeudas';

    public $timestamps=false;

    protected $fillable=[
    	'acreedor',
    	'amortizacionmensual',
    	'montodeuda',
    	'idempleado',
    	'identificacion',
        'motivodeuda',
    ];

}
