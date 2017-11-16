<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastoViajeEmpleado extends Model
{
    protected $table='gastoviajeempleado';
    protected $primaryKey='idgastoempleado';

    public $timestamps=false;

    protected $fillable=[
    	'idempleado',
    	'factura',
    	'fechafactura',
    	'montofactura',
    	'descripcion',
    	'codigocuenta',
    	'idproyecto',
    	'idgastoviaje',
        'check1',
        'check2'
    ];

    protected $guarder=[

    ];

}
