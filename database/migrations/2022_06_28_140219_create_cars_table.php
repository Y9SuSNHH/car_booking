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
            $table->string('address');
            $table->string('address2');
            $table->smallInteger('type');
            $table->smallInteger('slot');
            $table->boolean('transmission');
            $table->boolean('fuel');
            $table->integer('fuel_comsumpiton');
            $table->text('description')->nullable();
            $table->bigInteger('price_1_day');
            $table->bigInteger('price_insure');
            $table->bigInteger('price_service');
            $table->smallInteger('status');
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
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
