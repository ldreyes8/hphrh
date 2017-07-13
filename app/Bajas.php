<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bajas extends Model
{
    protected $table ='bajas';
    protected $primarykey ='idbaja';

    public $timestamps=false;
    
    protected $fillable=[
     	'fechabaja',
     	'motivo',
     	'comentarios',
     	'fechasistema',
     	'idempleado',
     ];
}
