<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacadetalle extends Model
{
    protected $table='vacadetalle';
    protected $primarykey='idvacadetalle';

    public $timestamps=false;
    
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
