<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Warteg extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'wartegs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'owner_name', 'address', 'phone', 'description', 'photo_profile', 'username', 'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'is_active',
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }


}
