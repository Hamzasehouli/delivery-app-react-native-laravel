<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cover_image',
        'adresse_street',
        'adresse_number',
        'adresse_zip',
        'adresse_city',
        'restaurant_category',
        'rating_average',
        'ratings',
        'delivery_fee',
        'delivery_time_min',
        'delivery_time_max',
        'item_id',
    ];
}
