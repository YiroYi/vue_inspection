<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCciactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cciactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->integer('item_number')->nullable();
            $table->string('spare_parts')->nullable();
            $table->integer('item_cnts')->nullable();
            $table->integer('sp_cnts')->nullable();
            $table->integer('total_cnts')->nullable();
            $table->integer('damaged_cnts')->nullable();
            $table->boolean('pallet_fumigate')->nullable();
            $table->string('container_number')->nullable();
            $table->string('seal_number')->nullable();
            $table->string('container_numberph')->nullable();
            $table->string('seal_numberph')->nullable();
            $table->boolean('fty_cooperate')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('result')->nullable();
            $table->timestamps();

            $table->foreign('iddetail')->references('id')->on('inspdetails');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cciactions');
    }
}
