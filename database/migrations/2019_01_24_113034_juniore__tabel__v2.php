<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JunioreTabelV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('juniorenDiscipline', function (Blueprint $table) {
        $table->increments('id');
        $table->text('klasse');
        $table->unsignedInteger('discipline_id');
        $table->timestamps();

        $table->foreign('discipline_id')->references('id')->on('discipline');
      });

      Schema::create('junioren', function (Blueprint $table) {
        $table->increments('id');
        $table->text('voornaam');
        $table->text('achternaam');
        $table->date('geboortedatum');

        $table->unsignedInteger('NBFS_id');
        $table->unsignedInteger('juniorenDiscipline_id');

        $table->timestamps();

        $table->foreign('NBFS_id')->references('id')->on('Gilde');
        $table->foreign('juniorenDiscipline_id')->references('id')->on('juniorenDiscipline');
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
      Schema::dropIfExists('juniorenDiscipline');
    }
}
