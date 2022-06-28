<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('user_id_start');
            $table->unsignedBigInteger('user_id_end');
            $table->foreign('user_id_start')->references('id')->on('users');
            $table->foreign('user_id_end')->references('id')->on('users');
            $table->foreignId('car_id')->constrained();
            $table->date('date_start');
            $table->date('date_end');
            $table->date('date_real_end');
            $table->float('total_price');
            $table->smallInteger('status');
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
        Schema::dropIfExists('bills');
    }
}
