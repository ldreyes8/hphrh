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
        'numerodependientes',
        'aportemensual',
        'vivienda',
        'alquilermensual',
        'otrosingresos',
        'pretension',
        'nit',
        'fechasolicitud',
        'fechaingreso',
        'idcivil',
        'idstatus',
        'observacion',
        'idjefeinmediato',    
    ];
    
    protected $guarded =[
        
    ];


}
