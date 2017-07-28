<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultado extends BaseModel
{
    protected $table='resultado';
    protected $primaryKey='idresultado';

    public $timestamps=false;

    protected $fillable=[
    	'idempleado',
    	'nota',
        'observacion',
        'evaluador',
        'area',
    ];

}
