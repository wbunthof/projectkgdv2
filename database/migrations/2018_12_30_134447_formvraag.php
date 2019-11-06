<?php
//
// Begin code van Wouter
//

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Formvraag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vraag', function (Blueprint $table)
        {
          $table->increments('id');
          $table->text('tekst');
          $table->text('placeholder')->nullable();
          $table->text('minimumValue')->nullable();
          $table->text('maximumValue')->nullable();
          $table->text('type');
          $table->text('formonderdeel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vraag');
    }
}
