<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cover_image');
            $table->string('adresse_street');
            $table->integer('adresse_number');
            $table->integer('adresse_zip');
            $table->string('adresse_city');
            $table->string('adresse_country');
            $table->string('restaurant_category')->nullable();
            $table->decimal('rating_average');
            $table->decimal('ratings');
            $table->decimal('delivery_fee_min');
            $table->decimal('delivery_fee_max')->nullable();
            $table->decimal('delivery_time_min');
            $table->decimal('delivery_time_max');
            $table->integer('item_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
