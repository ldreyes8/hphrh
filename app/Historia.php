<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    //
    protected $table='historia';
    protected $primarykey='idhistorial';

    public $timestamps=false;

    protected $fillable=[
    	'idempleado',
    	'idasignajefe',
    	'fecha',
    	'historia',
    	'comentario',
    	'adjunto',
    ];
}
