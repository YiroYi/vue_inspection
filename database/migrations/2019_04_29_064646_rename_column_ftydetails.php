<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnFtydetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ftygenonedetails', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailone');
      });

      Schema::table('ftygentwodetails', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailtwo');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('ftygenonedetails', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailone');
      });

      Schema::table('ftygentwodetails', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'iddetailtwo');
      });
    }
}
