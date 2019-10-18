<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFtyquestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ftyonequestions', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailqone');
      });

      Schema::table('ftytwoquestions', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailqtwo');
      });

      Schema::table('ftythreequestions', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailqthree');
      });

      Schema::table('ftyfourquestions', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailqfour');
      });

      Schema::table('ftyfivequestions', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailqfive');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('ftyonequestions', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailqone');
      });

      Schema::table('ftytwoquestions', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailqtwo');
      });

      Schema::table('ftythreequestions', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailqthree');
      });

      Schema::table('ftyfourquestions', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailqfour');
      });

      Schema::table('ftyfivequestions', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailqfive');
      });
    }
}
