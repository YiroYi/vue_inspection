<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyFtygendetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('Ftygenonedetails', function(Blueprint $table)
        {
          $table->foreign('iddetailone')->references('id')->on('inspdetails');
        });

        Schema::table('Ftygentwodetails', function(Blueprint $table)
          {
            $table->foreign('iddetailtwo')->references('id')->on('inspdetails');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('Ftygenonedetails', function(Blueprint $table)
        {
          $table->foreign('iddetailone')->references('id')->on('inspdetails');
        });

        Schema::table('Ftygentwodetails', function(Blueprint $table)
          {
            $table->foreign('iddetailtwo')->references('id')->on('inspdetails');
          });
    }
}
