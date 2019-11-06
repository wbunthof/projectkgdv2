<?php
//
// Begin code van Wouter
//

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BazuinblazenTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('discipline',  function (Blueprint $table)
      {
        $table->increments('id');
        $table->text('discipline');
        $table->timestamps();
      });

      Schema::create('Leden', function (Blueprint $table)
      {
        $table->increments('id');
        $table->text('voorletter');
        $table->text('voornaam');
        $table->text('tussenvoegsel')->nullable();
        $table->text('achternaam')->nullable();
        $table->date('geboortedatum')->nullable();
        $table->unsignedInteger('discipline');
        $table->foreign('discipline_id')->references('id')->on('discipline');
        $table->text('straat');
        $table->text('huisnummer');
        $table->text('plaats');

        $table->unsignedInteger('gemaakt_NBFS')->nullable();
        $table->foreign('gemaakt_NBFS')->references('id')->on('Gilde');
        $table->unsignedInteger('gemaakt_raadsheer')->nullable();
        $table->foreign('gemaakt_raadsheer')->references('id')->on('raadsheer');

        $table->timestamps();


      });

      Schema::create('bazuinblazen', function (Blueprint $table)
      {
        $table->increments('id');
        $table->unsignedInteger('leden_id')->nullable();
        $table->foreign('leden_id')->references('id')->on('Leden');
        $table->unsignedInteger('NBFS_id');
        $table->foreign('NBFS_id')->references('id')->on('Gilde');

        $table->text('naam')->nullable();
        $table->date('geboortedatum')->nullable();

        $table->integer('junioren');
        $table->integer('seniorenA');
        $table->integer('seniorenB');
        $table->integer('seniorenC');

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
        Schema::dropIfExsists([['discipline'],['leden'],['bazuinblazen']]);
    }
}
