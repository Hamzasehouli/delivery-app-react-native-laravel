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
            $table->string('title');
            $table->string('cover_image')->nullable();
            $table->string('adresse_street');
            $table->string('adresse_number');
            $table->string('adresse_zip');
            $table->string('adresse_city');
            $table->string('restaurant_category');
            $table->decimal('rating_average');
            $table->decimal('ratings');
            $table->decimal('delivery_fee');
            $table->decimal('delivery_time_min');
            $table->decimal('delivery_time_max');
            $table->integer('item_id')->nullable();
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
