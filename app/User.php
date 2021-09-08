<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url', 'age'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function recetas(){
        return $this->hasMany(Receta::class);
    }

    public function perfil(){
        return $this->hasOne(Perfil::class);
    }

    //Recetas a las que el usuario le ha dado MG
    public function meGusta(){
        return $this->belongsToMany(Receta::class);
    }

    protected static function booted(){
        parent::boot();

        //Asignar perfil una vez se haya creado un usuario nuevo
        static::created(function($user){
            $user->perfil()->create();
        });


    }
}

