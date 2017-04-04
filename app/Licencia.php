<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    //
    protected $table='personalicencia';
    protected $primarykey='idplicencia';

    public $timestamps=false;
    protected $fillable=
    [
    	'identificacion',
    	'idlicencia',
    	'vigencia',
    ];
}
