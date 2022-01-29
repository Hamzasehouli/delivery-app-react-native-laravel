<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('item_id');
            $table->string('adresse_street');
            $table->integer('adresse_number');
            $table->integer('adresse_zip');
            $table->string('adresse_city');
            $table->string('adresse_country');
            $table->integer('total_price');
            $table->string('phone');
            $table->string('tracking_number');
            $table->integer('delivery_time_min');
            $table->integer('delivery_time_max');
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
        Schema::dropIfExists('order');
    }
}
