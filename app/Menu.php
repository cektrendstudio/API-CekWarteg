<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'description','warteg_id', 'price', 'is_have_stock', 'photo',
    ];


    public function warteg()
    {
        return $this->belongsTo(Warteg::class, 'warteg_id');
    }

    protected $casts = [
        'is_active' => 'boolean',
        'is_have_stock' => 'boolean',
    ];

    public function review()
    {
        return $this->hasMany(Review::class);
    }

}
