<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastoViaje extends Model
{
    protected $table='gastoviaje';
    protected $primaryKey='idgastoviaje';

    public $timestamps=false;

    protected $fillable=[
    	'idgastocabeza',
    	'idviaje',
    ];

    protected $guarder=[

    ];
}
