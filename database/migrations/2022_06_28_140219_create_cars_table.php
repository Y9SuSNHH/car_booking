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
            $table->string('image')->nullable();
            $table->string('address');
            $table->integer('type')->nullable();
            $table->integer('slot')->nullable();
            $table->boolean('transmission')->nullable();
            $table->boolean('fuel')->nullable();
            $table->integer('fuel_comsumpiton')->nullable();
            $table->text('description')->nullable();
            $table->float('price_1_day')->nullable();
            $table->float('price_insure')->nullable();
            $table->float('price_service')->nullable();
            $table->boolean('status');
            $table->text('slug');
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
