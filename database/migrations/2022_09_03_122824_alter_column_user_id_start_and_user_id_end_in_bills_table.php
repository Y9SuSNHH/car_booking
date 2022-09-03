<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnUserIdStartAndUserIdEndInBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('bills', 'user_id_start')) {
            Schema::table('bills', function (Blueprint $table) {
                $table->renameColumn('user_id_start', 'staff_start');
            });
        }
        if (Schema::hasColumn('bills', 'user_id_end')) {
            Schema::table('bills', function (Blueprint $table) {
                $table->renameColumn('user_id_end', 'staff_end');
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
