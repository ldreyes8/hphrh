<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomytras extends BaseModel
{
    //
    protected $table='nomytras';
    protected $primarykey='idnomytas';

    public $timestamps=false;
    protected $fillable=
    [
    	'idpuesto',
    	'idempleado',
    	'fecha',
    	'salario',
    	'descripcion',
    	'idafiliado',
    	'idcaso',
    ];
}
