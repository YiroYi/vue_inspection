<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdserviceForeignOnFollowups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('followups', function(Blueprint $table)
        {
          $table->foreign('idservice')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('followups', function(Blueprint $table)
        {
          $table->foreign('idservice')->references('id')->on('services')->onDelete('cascade');
        });
    }
}
