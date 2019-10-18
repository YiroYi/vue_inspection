<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtyfourquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftyfourquestions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->foreign('iddetail')->references('id')->on('inspdetails');
            $table->boolean('q1Fi')->nullable();
            $table->boolean('q2Fi')->nullable();
            $table->boolean('q3Fi')->nullable();
            $table->boolean('q4Fi')->nullable();
            $table->boolean('q5Fi')->nullable();
            $table->string('img1Fi')->nullable();
            $table->string('img2Fi')->nullable();
            $table->boolean('q1Wh')->nullable();
            $table->boolean('q2Wh')->nullable();
            $table->boolean('q3Wh')->nullable();
            $table->boolean('q4Wh')->nullable();
            $table->boolean('q5Wh')->nullable();
            $table->string('img1Wh')->nullable();
            $table->string('img2Wh')->nullable();
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
        Schema::dropIfExists('ftyfourquestions');
    }
}
