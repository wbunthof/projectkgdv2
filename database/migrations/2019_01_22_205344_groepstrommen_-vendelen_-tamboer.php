<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroepstrommenVendelenTamboer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groep', function(Blueprint $table){
          $table->increments('id');
          $table->unsignedInteger('NBFS');
          $table->unsignedInteger('vraag_id');
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
        Schema::dropIfExists('groep');
    }
}
