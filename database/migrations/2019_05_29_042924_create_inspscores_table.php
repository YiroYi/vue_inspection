<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspscores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->foreign('iddetail')->references('id')->on('inspdetails');
            $table->boolean('chQone')->nullable();
            $table->boolean('chQtwo')->nullable();
            $table->string('chEtwo')->nullable();
            $table->boolean('chPthree')->nullable();
            $table->integer('chPfour')->nullable();
            $table->integer('chEvfour')->nullable();
            $table->boolean('chQfive')->nullable();
            $table->boolean('chQsix')->nullable();
            $table->LongText('chRemarks')->nullable();
            $table->integer('chScore')->nullable();
            $table->boolean('mxQone')->nullable();
            $table->boolean('mxQtwo')->nullable();
            $table->string('mxEtwo')->nullable();
            $table->boolean('mxPthree')->nullable();
            $table->integer('mxPfour')->nullable();
            $table->integer('mxEvfour')->nullable();
            $table->boolean('mxQfive')->nullable();
            $table->boolean('mxQsix')->nullable();
            $table->longText('mxRemarks')->nullable();
            $table->integer('mxScore')->nullable();
            $table->integer('ttScore')->nullable();
            $table->integer('globexPoints')->nullable();
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
        Schema::dropIfExists('inspscores');
    }
}
