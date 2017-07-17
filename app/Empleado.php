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


    public function persona(){
        return $this->hasOne('App\Persona', 'identificacion','identificacion');     
    }

    public function caso(){
        return $this->belongsToMany('App\Caso', 'nomytras', 'idempleado', 'idcaso');     
    }

    public function scopeBusqueda($query,$caso,$dato="")
    {
        if($caso==0){ 
            $resultado = $query->whereHas("persona",function($query) use ($dato)
            {
                $query->persona($dato)->where('empleado.idstatus','!=', 5);
            });
        }

        else{
            $resultado = $query->whereHas("caso",function($query) use ($caso,$dato)
            {
                $query->caso($caso);
            })->whereHas("persona",function($query) use ($dato)
            {
                $query->persona($dato)->where('empleado.idstatus','!=', 5);
            });
        }                
    return  $resultado;
    }
}
