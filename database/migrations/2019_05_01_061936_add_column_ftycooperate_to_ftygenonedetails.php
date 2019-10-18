<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnFtycooperateToFtygenonedetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ftygenonedetails', function (Blueprint $table) {
            $table->string('fty_cooperate')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('ftygenonedetails', function (Blueprint $table) {
            $table->string('fty_cooperate')->nullable();
      });
    }
}
