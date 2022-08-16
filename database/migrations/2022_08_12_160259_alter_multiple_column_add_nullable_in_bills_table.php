<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMultipleColumnAddNullableInBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('bills', 'date_real_end')) {
            Schema::table('bills', function(Blueprint $table) {
                $table->date('date_real_end')->nullable()->change();
            });
        }
        if (Schema::hasColumn('bills', 'user_id_start')) {
            Schema::table('bills', function(Blueprint $table) {
                $table->unsignedBigInteger('user_id_start')->nullable()->change();
            });
        }
        if (Schema::hasColumn('bills', 'user_id_end')) {
            Schema::table('bills', function(Blueprint $table) {
                $table->unsignedBigInteger('user_id_end')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
