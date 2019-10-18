<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspectors', function (Blueprint $table) {
          $table->increments('id');
          $table->string('en_name',100);
          $table->string('cn_name',100);
          $table->string('type',100);
          $table->string('email');
          $table->string('phone');
          $table->string('province');
          $table->string('city');
          $table->string('back_account');
          $table->longText('remarks');
          $table->string('score')->default('D');
          $table->boolean('status')->default(1);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspectors');
    }
}
