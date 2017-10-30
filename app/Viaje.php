<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    protected $table='viaje';
    protected $primaryKey='idviaje';

    public $timestamps=false;

    protected $fillable=[
    	'fechainicio',
    	'fechafin',
    	'numerodias',
    	'motivo',
    ];

    protected $guarder=[

    ];
}
