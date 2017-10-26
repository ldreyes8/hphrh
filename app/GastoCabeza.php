<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastoCabeza extends Model
{
    protected $table='gastoencabezado';
    protected $primaryKey='idgastocabeza';

    public $timestamps = false;
    
    protected $fillable =[
    	'fechasolicitud',
        'montosolicitado',
        'chequetransfe',
    	'montogastado',
        'statusgasto',
    ];
}
