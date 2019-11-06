<?php
//
// Begin code van Wouter
//

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableGildemisTentoonstellingGeweerStandaardrijden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('gildemis', function (Blueprint $table)
      {
        $table->increments('id');
        $table->unsignedInteger('NBFS');
        $table->foreign('NBFS')->references('id')->on('Gilde');
        $table->unsignedInteger('vraag_id');
        $table->foreign('vraag_id')->references('id')->on('vraag');
        $table->longText('antwoord');
        $table->timestamps();
      });
      Schema::create('tentoonstelling', function (Blueprint $table)
      {
        $table->increments('id');
        $table->unsignedInteger('NBFS');
        $table->foreign('NBFS')->references('id')->on('Gilde');
        $table->unsignedInteger('vraag_id');
        $table->foreign('vraag_id')->references('id')->on('vraag');
        $table->longText('antwoord');
        $table->timestamps();
      });
      Schema::create('geweer', function (Blueprint $table)
      {
        $table->increments('id');
        $table->unsignedInteger('NBFS');
        $table->foreign('NBFS')->references('id')->on('Gilde');
        $table->unsignedInteger('vraag_id');
        $table->foreign('vraag_id')->references('id')->on('vraag');
        $table->longText('antwoord');
        $table->timestamps();
      });
    Schema::create('standaardrijden', function (Blueprint $table)
    {
      $table->increments('id');
      $table->unsignedInteger('NBFS');
      $table->foreign('NBFS')->references('id')->on('Gilde');
      $table->unsignedInteger('vraag_id');
      $table->foreign('vraag_id')->references('id')->on('vraag');
      $table->longText('antwoord');
      $table->timestamps();
    });
    Schema::create('kruis-handboog', function (Blueprint $table)
    {
      $table->increments('id');
      $table->unsignedInteger('NBFS');
      $table->foreign('NBFS')->references('id')->on('Gilde');
      $table->unsignedInteger('vraag_id');
      $table->foreign('vraag_id')->references('id')->on('vraag');
      $table->longText('antwoord');
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
        Schema::drop('gildemis');
        Schema::drop('tentoonstelling');
        Schema::drop('geweer');
        Schema::drop('standaardrijden');
        Schema::drop('kruis-handboog');
    }
}
