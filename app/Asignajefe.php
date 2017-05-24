<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignajefe extends Model
{
    //
    protected $table ='asignajefe';
    protected $primarykey ='idasignajefe';

    public $timestamps=false;
    
    protected $fillable=[
     	'identificacion',
     	'idempleado',
     	'notifica',
     ];
}
