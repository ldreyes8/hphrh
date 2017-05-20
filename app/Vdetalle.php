<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vdetalle extends Model
{
    protected $primarykey='idvacadetalle';
    protected $table='vacadetalle';
    

    public $timestamps = false;
    
    protected $fillable =[
    	'idempleado',
        'idausencia',
        'periodo',
    	'acuhoras',
        'acudias',
        'solhoras',
    	'fecharegistro',
        'soldias',
        ];
}
