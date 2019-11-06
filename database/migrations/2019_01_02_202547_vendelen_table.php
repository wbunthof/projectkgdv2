<?php
//
// Begin code van Wouter
//

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VendelenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('vendelen', function (Blueprint $table)
      {
        $table->increments('id');
        $table->unsignedInteger('leden_id')->nullable();
        $table->foreign('leden_id')->references('id')->on('Leden');
        $table->unsignedInteger('NBFS_id');
        $table->foreign('NBFS_id')->references('id')->on('Gilde');

        $table->text('naam')->nullable();
        $table->date('geboortedatum')->nullable();

        $table->integer('junioren');
        $table->integer('seniorenV-za');
        $table->integer('seniorenA');
        $table->integer('seniorenB');
        $table->integer('seniorenC');
        $table->integer('seniorenE');

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
