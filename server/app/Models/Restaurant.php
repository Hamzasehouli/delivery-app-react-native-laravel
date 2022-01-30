<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover_image',
        'adresse_street',
        'adresse_number',
        'adresse_zip',
        'adresse_city',
        'adresse_country',
        'restaurant_category',
        'rating_average',
        'ratings',
        'delivery_fee_min',
        'delivery_fee_max',
        'delivery_time_min',
        'delivery_time_max',
        'item_id',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
