<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Warteg extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    protected $table = 'wartegs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'owner_name', 'address', 'phone', 'description', 'photo_profile', 'username', 'password', 'email', 'is_approve', 'is_active',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_approve' => 'boolean',
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
