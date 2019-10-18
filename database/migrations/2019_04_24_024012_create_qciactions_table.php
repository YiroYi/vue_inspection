<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQciactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qciactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->string('aql_level')->nullable();
            $table->string('production_status')->nullable();
            $table->integer('item_number')->nullable();
            $table->string('inspection_result')->nullable();
            $table->string('fty_cooperate')->nullable();
            $table->string('remarks')->nullable();
            $table->string('opened_samplePh')->nullable();
            $table->string('sealed_samplePh')->nullable();
            $table->string('product_picture')->nullable();
            $table->string('sampling_picture')->nullable();
            $table->string('printed_plPh')->nullable();
            $table->string('acknowledgmentPh')->nullable();
            
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
        Schema::dropIfExists('qciactions');
    }
}
