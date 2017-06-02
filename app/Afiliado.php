<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class afiliado extends Model
{
    protected $table = 'afiliado';
    public function Ugaleria()
    {
    	return $this->hasMany('App\nomytas','idafiliado','idafiliado');
    }
}
