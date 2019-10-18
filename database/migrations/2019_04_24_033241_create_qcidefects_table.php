<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQcidefectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qcidefects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idqciaction')->unsigned();
            $table->foreign('idqciaction')->references('id')->on('qciactions')->onDelete('cascade');
            $table->string('product_code')->nullable();
            $table->string('product_description')->nullable();
            $table->integer('sample_size')->nullable();
            $table->integer('minor_defects')->nullable();
            $table->integer('major_defects')->nullable();
            $table->integer('critical_defects')->nullable();
            $table->integer('total')->nullable();
            $table->string('result')->nullable();
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
        Schema::dropIfExists('qcidefects');
    }
}
