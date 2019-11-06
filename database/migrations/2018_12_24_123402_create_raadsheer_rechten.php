<?php
//
// Begin code van Wouter
//

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaadsheerRechten extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raadsheerRechten', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('raadsheer_id');
            $table->foreign('raadsheer_id')->references('id')->on('raadsheer');
            $table->string('formOnderdeel');
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
        Schema::dropIfExists('raadsheerRechten');
    }
}
