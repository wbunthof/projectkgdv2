<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LastLoginDateToUserTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gilde', function (Blueprint $table) {
            $table->dateTime('last_login_at')->nullable();
        });
        Schema::table('raadsheer', function (Blueprint $table) {
            $table->dateTime('last_login_at')->nullable();
        });
        Schema::table('organiser', function (Blueprint $table) {
            $table->dateTime('last_login_at')->nullable();
        });
        Schema::table('admin', function (Blueprint $table) {
            $table->dateTime('last_login_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
