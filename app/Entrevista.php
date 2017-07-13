<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    //
    protected $table='entrevista';
    protected $primaryKey='identrevista';

    public $timestamps=false;

    protected $fillable=[
    	'fechaentre',
    	'lugar',
    	'aportefamilia',
    	'cargasfamiliares',
    	'mcorto',
        'mmediano',
        'mlargo',
        'descpersonal',
        'trabajoequipo',
        'bajopresion',
        'atencionpublico',
        'ordenado',
        'presentacion',
        'disponibilidad',
        'dispoviajar',
        'dispfinsemana',
        'comunicar',
        'pretensionminima',
        'entrevistadores',
        'perentrevista',
        'vivecompania',
    ];

}

