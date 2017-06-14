<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    //
    protected $table='personalicencia';
    protected $primaryKey='idplicencia';

    public $timestamps=false;
    protected $fillable=
    [
    	'identificacion',
    	'idlicencia',
    	'vigencia',
    ];
}
