<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id', 'code', 'name', 'review_text'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }


}
