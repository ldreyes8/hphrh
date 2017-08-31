<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacoravacante extends Model
{
    protected $primaryKey='idbitacoravacante';
    protected $table='bitacoravacante';
    

    public $timestamps = false;
    
    protected $fillable =[
    	
    	'idpuesto',
    	'idafiliado',
    	'status',
    	'idpersona',
    	'idusuario',
    	'fechasol',        
        ];
}
