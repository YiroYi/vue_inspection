<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnnModifiedByOnMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('monitors', function (Blueprint $table) {
        $table->string('modified_by_id')->nullable();
        $table->string('modified_by')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('monitors', function (Blueprint $table) {
        $table->string('modified_by_id')->nullable();
        $table->string('modified_by')->nullable();
      });
    }
}
