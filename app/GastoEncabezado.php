<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastoEncabezado extends Model
{
    //
    protected $table='gastoencabezado';
    protected $primaryKey='idgastocabeza';

    public $timestamps=false;

    protected $fillable=[
    	'fechasolicitud',
    	'montosolicitado',
    	'chequetransfe',
    	'montogastado',
    	'fechaliquidacion',
    	'moneda',
        'periodo',
    	'idtipogasto',
    	'idproyecto',
        'idempleado',
        'statusgasto',
        'statuspago'
    ];

    protected $guarder=[

    ];

}
