<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    protected $table='caso';
    protected $primaryKey='idcaso';

    public $timestamps=false;

    protected $fillable=[
    	'nombre',
    ];


    public function scopeCaso($query,$caso)
    {
        return $query->where('caso.idcaso', '=', $caso);
    }
}
