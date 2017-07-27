<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignajefe extends BaseModel
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
