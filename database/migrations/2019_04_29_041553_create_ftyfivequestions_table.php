<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtyfivequestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftyfivequestions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->foreign('iddetail')->references('id')->on('inspdetails');
            $table->boolean('q1Ef')->nullable();
            $table->boolean('q2Ef')->nullable();
            $table->boolean('q3Ef')->nullable();
            $table->boolean('q4Ef')->nullable();
            $table->boolean('q5Ef')->nullable();
            $table->string('img1Ef')->nullable();
            $table->string('img2Ef')->nullable();
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
        Schema::dropIfExists('ftyfivequestions');
    }
}
