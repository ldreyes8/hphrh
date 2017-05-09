<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomytras extends Model
{
    //
    protected $table='nomytras';
    protected $primarykey='idnomytras';

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
