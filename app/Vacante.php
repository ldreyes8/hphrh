<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
 	protected $primaryKey='idvacante';
    protected $table='vacante';
    

    public $timestamps = false;
    
    protected $fillable =[
    	'fecha',
        'idafiliado',
        'idpuesto',
    	'idusuario',
        'status',
        ];
}
