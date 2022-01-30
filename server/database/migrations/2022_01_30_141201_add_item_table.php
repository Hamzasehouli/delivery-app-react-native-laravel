<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('restaurant_id');
            $table->string('name');
            $table->string('image');
            $table->enum('type', ['sole', 'menu'])->default('sole');
            $table->json('extra')->nullable();
            $table->json('drinks')->nullable();
            $table->json('fries')->nullable();
            $table->json('sauce')->nullable();
            $table->json('removed_ingredients')->nullable();
            $table->decimal('price');
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
        Schema::dropIfExists('items');
    }
}
