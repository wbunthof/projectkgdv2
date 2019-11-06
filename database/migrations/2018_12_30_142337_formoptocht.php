<?php
//
// Begin code van Wouter
//

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Formoptocht extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('optocht', function (Blueprint $table)
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
         Schema::drop('optocht');
     }
}
