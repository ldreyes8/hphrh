<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deudas extends Model
{
    //
    protected $table='personadeudas';
    protected $primarykey='idpdeudas';

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
