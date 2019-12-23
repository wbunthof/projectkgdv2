<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RaadsheerFormulierOnderdeelPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formonderdeel_raadsheer', function (Blueprint $table) {
            $table->integer('formonderdeel_id')->unsigned()->index();
            $table->foreign('formonderdeel_id')->references('id')->on('formoOnderdelen')->onDelete('cascade');

            $table->integer('raadsheer_id')->unsigned()->index();
            $table->foreign('raadsheer_id')->references('id')->on('raadsheer')->onDelete('cascade');

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
        Schema::dropIfExists('formonderdeel_raadsheer');
    }
}
