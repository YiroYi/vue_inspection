<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtythreequestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftythreequestions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->foreign('iddetail')->references('id')->on('inspdetails');
            $table->boolean('q1Iin')->nullable();
            $table->boolean('q2Iin')->nullable();
            $table->boolean('q3Iin')->nullable();
            $table->boolean('q4Iin')->nullable();
            $table->boolean('q5Iin')->nullable();
            $table->string('img1Iin')->nullable();
            $table->string('img2Iin')->nullable();
            $table->boolean('q1Qm')->nullable();
            $table->boolean('q2Qm')->nullable();
            $table->boolean('q3Qm')->nullable();
            $table->boolean('q4Qm')->nullable();
            $table->boolean('q5Qm')->nullable();
            $table->string('img1Qm')->nullable();
            $table->string('img2Qm')->nullable();
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
        Schema::dropIfExists('ftythreequestions');
    }
}
