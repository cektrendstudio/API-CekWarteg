<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'description','warteg_id', 'price', 'is_have_stock', 'photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'is_active',
    ];

    public function warteg(){
        return $this->belongsTo(Warteg::class, 'warteg_id');
    }


}
