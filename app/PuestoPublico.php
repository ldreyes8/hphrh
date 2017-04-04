<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuestoPublico extends Model
{
    //
    protected $table='puestopublico';
    protected $primarykey='idpublico';

    public $timestamps=false;
    protected $fillable=
    [
    	'identificacion',
    	'nombre',
    	'puesto',
    	'dependencia',
    ];
}
