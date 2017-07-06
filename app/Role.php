<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'roles';
    protected $fillable = array('name','slug','descripcion');
    public $timestamps = false;

    public function scopeRol($query,$rol)
    {
        return $query->where('id', '=', $rol);
    }
}
