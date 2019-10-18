<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoSizeToInspdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('inspdetails', function (Blueprint $table) {
            $table->string('check_inPhSize')->nullable();
            $table->string('check_outPhSize')->nullable();
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
            $table->string('check_inPhSize')->nullable();
            $table->string('check_outPhSize')->nullable();
      });
    }
}
