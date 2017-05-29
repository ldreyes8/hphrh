<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacadetalle extends Model
{
    protected $primaryKey = 'idvacadetalle';
    protected $table = 'vacadetalle';
    protected $fillable = array('idempleado',
        'idausencia',
        'periodo',
        'acuhoras',
        'acudias',
        'solhoras',
        'fecharegistro',
        'soldias');

    public $timestamps = false;



    protected $dates = [
        'fini',
        'ffin'
    ];
}
