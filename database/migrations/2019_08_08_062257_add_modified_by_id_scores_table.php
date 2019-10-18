<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModifiedByIdScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('inspscores', function (Blueprint $table) {
        $table->string('modified_cnby_id')->nullable();
        $table->string('modified_cnby')->nullable();
        $table->string('modified_mxby_id')->nullable();
        $table->string('modified_mxby')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('inspscores', function (Blueprint $table) {
        $table->string('modified_cnby_id')->nullable();
        $table->string('modified_cnby')->nullable();
        $table->string('modified_mxby_id')->nullable();
        $table->string('modified_mxby')->nullable();
      });
    }
}
