<?php
//
// Begin code van Wouter
//

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeelnameMeerdereWedstrijdenTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('DeelnameMeerdereWedstrijden', function (Blueprint $table)
      {
        $table->increments('id');
        $table->unsignedInteger('NBFS_id');
        $table->foreign('NBFS_id')->references('id')->on('Gilde');
        $table->unsignedInteger('discipline_id')->nullable();
        $table->foreign('discipline_id')->references('id')->on('discipline');

        $table->text('naam');
        $table->text('disciplines');

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
        //
    }
}
