<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignIdfollowupServicetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('services', function(Blueprint $table)
        {
          $table->foreign('idfollowup')->references('id')->on('followups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('services', function(Blueprint $table)
        {
        $table->dropForeign('idfollowup'); //
        });
    }
}
