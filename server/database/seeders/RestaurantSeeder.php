<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants')->insert([
            'name' => 'mcDonald\'s',
            'cover_image' => 'nothing',
            'adresse_street' => 'malabata',
            'adresse_number' => 2,
            'adresse_zip' => 90100,
            'adresse_city' => 'tangier',
            'adresse_country' => 'morocco',
            'restaurant_category' => 'halal',
            'restaurant_category' => 'fast food',
            'restaurant_category' => 'breakfast and drinks',
            'rating_average' => 4.5,
            'ratings' => 122,
            'delivery_fee_min' => 7,
            // 'delivery_fee_max' => 7,
            'delivery_time_min' => 20,
            'delivery_time_max' => 45,
            'item_id' => 1,
        ]);
    }
}
