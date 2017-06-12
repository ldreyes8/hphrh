<?php

namespace App;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyResetPassword;

class User extends Authenticatable
{

    use Notifiable;
    use ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
        'name', 'email', 'password','identificacion','fotoperfil','idusuario',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }


    public function scopeBusqueda($query,$afiliado,$dato="")
    {
        if($afiliado==0){ 
            $resultado= $query->where('nombres','like','%'.$dato.'%')
            ->orWhere('apellidos','like', '%'.$dato.'%')
            ->orWhere('email','like', '%'.$dato.'%');
        }
        else{
               
            //select * from users where pais = $pais  and (nombres like %$dato% or apellidos like %$dato%  or email like  %$dato% )
            $resultado= $query->where("idafiliado","=",$afiliado)
            ->Where(function($q) use ($afiliado,$dato)  {
            $q->where('nombres','like','%'.$dato.'%')
            ->orWhere('apellidos','like', '%'.$dato.'%')
            ->orWhere('email','like', '%'.$dato.'%');       
            });

        }                     
    return  $resultado;
    }
    public function scopeName($query,$name)
    {
        if(trim($name) != "")
        {
            $query->where('name','LIKE','%'.$name.'%');
        }
    }
}
