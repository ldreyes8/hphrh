<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nomytas extends Model
{
	protected $table='nomytas';
    protected $primaryKey='idnomytas';

    public $timestamps=false;

    protected $fillable=[
    	'idpuesto',
    	'idempleado',
    	'fecha',
    	'salario',
    	'descripcion',
    	'codigoconta',
    	'idafiliado',
    	'idcaso',
    ];

}
