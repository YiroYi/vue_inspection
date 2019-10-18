<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInpsContainPhToCciactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('cciactions', function (Blueprint $table) {
            $table->string('inspContPh')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('cciactions', function (Blueprint $table) {
            $table->string('inspContPh')->nullable();
      });
    }
}
