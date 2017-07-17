<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table='persona';
    protected $primaryKey='identificacion';

    public $timestamps=false;
    
    protected $fillable =[
    	'nombre1',
        'nombre2',
        'nombre3',
    	'apellido1',
        'apellido2',
        'apellido3',
    	'telefono',
        'celular',
        'avenida',
        'calle',
        'nomenclatura',
        'zona',
        'barriocolonia',    	
    	'idmunicipio',
        'ive',
        'parientepolitico',
        'finiquitoive',
        'fechanac',
        'correo',
        'genero',
        'idetnia',
        'idnacionalidad',
        'iddocumento',
        'idafiliado',
        'idpuesto',
        'idpais',
    ];

    protected $guarder =[

    ];
  

    public function scopePersona($query,$dato="")
    {

        return $query->where('nombre1','like','%'.$dato.'%')
            ->orwhere('nombre2','like','%'.$dato.'%')
            ->orwhere('apellido1','like','%'.$dato.'%')
            ->orwhere('apellido2','like','%'.$dato.'%')
            ->orwhere(\DB::raw("CONCAT(nombre1,' ',apellido1)"),'like','%'.$dato.'%');
    }
}
