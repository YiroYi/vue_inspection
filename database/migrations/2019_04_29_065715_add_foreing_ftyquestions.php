<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingFtyquestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ftyonequestions', function(Blueprint $table)
        {
          $table->foreign('iddetailqone')->references('id')->on('inspdetails');
        });

        Schema::table('ftytwoquestions', function(Blueprint $table)
          {
            $table->foreign('iddetailqtwo')->references('id')->on('inspdetails');
          });

          Schema::table('ftythreequestions', function(Blueprint $table)
            {
              $table->foreign('iddetailqthree')->references('id')->on('inspdetails');
            });

            Schema::table('ftyfourquestions', function(Blueprint $table)
              {
                $table->foreign('iddetailqfour')->references('id')->on('inspdetails');
              });

              Schema::table('ftyfivequestions', function(Blueprint $table)
                {
                  $table->foreign('iddetailqfive')->references('id')->on('inspdetails');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('ftyonequestions', function(Blueprint $table)
        {
          $table->foreign('iddetailqone')->references('id')->on('inspdetails');
        });

        Schema::table('ftytwoquestions', function(Blueprint $table)
          {
            $table->foreign('iddetailqtwo')->references('id')->on('inspdetails');
          });

          Schema::table('ftythreequestions', function(Blueprint $table)
            {
              $table->foreign('iddetailqthree')->references('id')->on('inspdetails');
            });

            Schema::table('ftyfourquestions', function(Blueprint $table)
              {
                $table->foreign('iddetailqfour')->references('id')->on('inspdetails');
              });

              Schema::table('ftyfivequestions', function(Blueprint $table)
                {
                  $table->foreign('iddetailqfive')->references('id')->on('inspdetails');
                });
    }
}
