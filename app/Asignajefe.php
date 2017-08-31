<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignajefe extends BaseModel
{
    //
    protected $table ='asignajefe';
    protected $primaryKey ='idasignajefe';

    public $timestamps=false;
    
    protected $fillable=[
     	'identificacion',
     	'idempleado',
     	'notifica',
     ];
}
