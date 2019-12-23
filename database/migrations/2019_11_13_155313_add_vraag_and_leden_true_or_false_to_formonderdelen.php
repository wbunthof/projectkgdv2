<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVraagAndLedenTrueOrFalseToFormonderdelen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formOnderdelen', function (Blueprint $table) {
            $table->tinyInteger('vragen');
            $table->tinyInteger('leden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formonderdelen', function (Blueprint $table) {
            //Cant only drop columns
        });
    }
}
