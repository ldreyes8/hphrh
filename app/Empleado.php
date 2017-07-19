<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    //Relacion mucho a mucos entre persona y empleado para llamar asignajefe.
    public function personas()
    {
        return $this->belongsToMany('App\Persona','asignajefe','idempleado','identificacion');
    }

    /**
     * Get all user roles.
     *
     * @return array|null
     */
    public function getpersonas()
    {
        if (!is_null($this->personas)) {
            return $this->personas
                        ->pluck('nombre1')->all();
        }
    }


    public function revokePersona($identificacion = '')
    {
        return $this->personas()->detach($identificacion);
    }


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
