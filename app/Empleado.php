<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $table='empleado';
    protected $primaryKey = 'idempleado';
    
    public $timestamps=false;
    
    protected $fillable = [
        'identificacion',
        'afiliacionigss',
        'tipolicencia',
        'numerodependientes',
        'aportemensual',
        'vivienda',
        'alquilermensual',
        'otrosingresos',
        'pretension',
        'nit',
        'dpiadjunto',
        'fechasolicitud',
        'fechaingreso',
        'idcivil',
        'idpuesto',
        'idstatus',
        'idafiliado',
        'observacion'    
    ];
    
    protected $guarded =[
        
    ];
}
