<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends BaseModel
{
    protected $table='puesto';
    protected $primaryKey='idpuesto';

    public $timestamps=false;
    protected $fillable=
    [
    	'nombre',
    	'descripcion',
    	'fechacreacion',
    	'statusp',
    ];
}
