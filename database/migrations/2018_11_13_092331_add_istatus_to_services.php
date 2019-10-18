<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIstatusToServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('services', function($table) {
      $table->integer('idistatus')->unsigned();
      $table->foreign('idistatus')->references('id')->on('istatus');
  });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('services', function($table) {
      $table->dropColumn('idistatus');
  });
    }
}
