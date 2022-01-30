<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'name',
        'image',
        'type',
        'extra',
        'drinks',
        'fries',
        'sauce',
        'removed_ingredients',
        'price',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
