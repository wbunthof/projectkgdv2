<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JuniorenTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junioren', function (Blueprint $table) {
          $table->increments('id');
          $table->text('voornaam');
          $table->text('achternaam');
          $table->date('geboortedatum');
          $table->unsignedInteger('NBFS');
          $table->unsignedInteger('discipline_id');
          $table->timestamps();

          $table->foreign('NBFS')->references('id')->on('Gilde');
          $table->foreign('discipline_id')->references('id')->on('discipline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('junioren');
    }
}
