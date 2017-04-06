<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tausencia extends Model
{
    protected $primaryKey = 'idtipoausencia';
    protected $table = 'tipoausencia';
    protected $fillable = array('ausencia','descripcion');
    public $timestamps = false;
}
