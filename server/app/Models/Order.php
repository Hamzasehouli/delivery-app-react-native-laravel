<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'adresse_street',
        'adresse_number',
        'adresse_zip',
        'adresse_city',
        'adresse_country',
        'total_price',
        'phone',
        'tracking_number',
        'delivery_time_min',
        'delivery_time_max',
    ];

}
