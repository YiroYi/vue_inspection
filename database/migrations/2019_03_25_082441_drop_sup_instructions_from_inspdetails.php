<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSupInstructionsFromInspdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('inspdetails', function (Blueprint $table) {
          $table->dropColumn('sup_intructions');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('inspdetails', function (Blueprint $table) {
          $table->dropColumn('sup_intructions');
      });
    }
}
