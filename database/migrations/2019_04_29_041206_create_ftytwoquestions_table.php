<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtytwoquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftytwoquestions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->foreign('iddetail')->references('id')->on('inspdetails');
            $table->boolean('q1Plm')->nullable();
            $table->boolean('q2Plm')->nullable();
            $table->boolean('q3Plm')->nullable();
            $table->boolean('q4Plm')->nullable();
            $table->boolean('q5Plm')->nullable();
            $table->string('img1Plm')->nullable();
            $table->string('img2Plm')->nullable();
            $table->boolean('q1Mp')->nullable();
            $table->boolean('q2Mp')->nullable();
            $table->boolean('q3Mp')->nullable();
            $table->boolean('q4Mp')->nullable();
            $table->boolean('q5Mp')->nullable();
            $table->string('img1Mp')->nullable();
            $table->string('img2Mp')->nullable();
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
        Schema::dropIfExists('ftytwoquestions');
    }
}
