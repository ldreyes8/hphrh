<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    //
    protected $table='personafamilia';
    protected $primaryKey='idpfamilia';

    public $timestamps=false;

    protected $fillable=[
    	'parentezco',
    	'ocupacion',
    	'edad',
    	'nombref',
    	'apellidof',
    	'telefonof',
        'emergencia',
    	'idempleado',
    	'identificacion',
        'observacion',
    ];

    protected $guarder=[

    ];
}
