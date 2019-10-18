<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameIddetailcolumnMonitorsTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('monitors', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'idservice');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('monitors', function(Blueprint $table) {
          $table->renameColumn('iddetail', 'idservice');
      });
    }
}
