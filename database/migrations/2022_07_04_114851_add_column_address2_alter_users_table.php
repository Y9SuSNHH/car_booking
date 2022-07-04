<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAddress2AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'address2')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string("address2")->nullable()->after('address');
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
        if (Schema::hasColumn('users', 'address2')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('address2');
            });
        }
    }
}
