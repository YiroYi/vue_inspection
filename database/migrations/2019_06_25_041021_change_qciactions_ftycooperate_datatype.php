<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeQciactionsFtycooperateDatatype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('qciactions', function(Blueprint $table){
        $table->boolean('fty_cooperate')->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('qciactions', function(Blueprint $table){
        $table->boolean('fty_cooperate')->change();
      });
    }
}
