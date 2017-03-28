<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    //
    protected $table='personafamilia';
    protected $primarykey='idpfamilia';

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
    	'identificacion'
    ];

    protected $guarder=[

    ];
}
