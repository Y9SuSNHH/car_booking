<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('brand');
            $table->string('address');
            $table->integer('type');
            $table->integer('slot');
            $table->boolean('transmission');
            $table->boolean('fuel');
            $table->integer('fuel_comsumpiton');
            $table->text('description');
            $table->float('price_1_day');
            $table->float('price_insure');
            $table->float('price_service');
            $table->boolean('status');
            $table->text('slug');
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
        Schema::dropIfExists('cars');
    }
}
