<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtyonequestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftyonequestions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->foreign('iddetail')->references('id')->on('inspdetails');
            $table->boolean('q1Pa')->nullable();
            $table->boolean('q2Pa')->nullable();
            $table->boolean('q3Pa')->nullable();
            $table->boolean('q4Pa')->nullable();
            $table->boolean('q5Pa')->nullable();
            $table->string('img1Pa')->nullable();
            $table->string('img2Pa')->nullable();
            $table->boolean('q1Ce')->nullable();
            $table->boolean('q2Ce')->nullable();
            $table->boolean('q3Ce')->nullable();
            $table->boolean('q4Ce')->nullable();
            $table->boolean('q5Ce')->nullable();
            $table->string('img1Ce')->nullable();
            $table->string('img2Ce')->nullable();
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
        Schema::dropIfExists('ftyonequestions');
    }
}
