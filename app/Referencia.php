<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    //
    protected $table='personareferencia';
    protected $primaryKey='idpreferencia';

    public $timestamps=false;

    protected $fillable=[
    	'nombrer',
    	'telefonor',
    	'profesion',
    	'tiporeferencia',
    	'idempleado',
    	'identificacion'
    ];

    protected $guarder=[

    ];
}
