<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSuppliersInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('suppliers', function($table) {
      $table->string('name',100);
      $table->string('short_name',100)->unique()->nullable();
      $table->string('email');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('suppliers', function($table) {
      $table->string('name',100);
      $table->string('short_name',100)->unique()->nullable();
      $table->string('email');
      });
    }
}
