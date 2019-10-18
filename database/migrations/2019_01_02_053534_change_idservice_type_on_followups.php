<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIdserviceTypeOnFollowups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('followups', function(Blueprint $table){
        $table->integer('idservice')->nullable(false)->change();
        $table->integer('idservice')->unsigned()->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('followups', function(Blueprint $table){
        $table->integer('idservice')->nullable(false)->change();
        $table->integer('idservice')->unsigned()->change();
      });
    }
}
