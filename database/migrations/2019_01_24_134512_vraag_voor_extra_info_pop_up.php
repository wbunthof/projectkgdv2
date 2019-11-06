<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VraagVoorExtraInfoPopUp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vraag', function (Blueprint $table)
        {
          $table->longText('extraInfo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('vraag', function (Blueprint $table)
      {
        $table->dropColumn('extraInfo');
      });
    }
}
