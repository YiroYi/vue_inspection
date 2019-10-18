<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIdkeyInspectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('inspectors', function(Blueprint $table){
        $table->integer('id')->unsigned()->change();
        $table->foreign('id')->references('id')->on('customers')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('inspectors', function(Blueprint $table){
        $table->integer('id')->unsigned()->change();
        $table->foreign('id')->references('id')->on('customers')->onDelete('cascade');
      });
    }
}
