<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->foreign('iddetail')->references('id')->on('inspdetails');
            $table->string('first_evidence')->nullable();
            $table->longText('fe_remarks')->nullable();
            $table->string('second_evidence')->nullable();
            $table->longText('se_remarks')->nullable();
            $table->string('third_evidence')->nullable();
            $table->longText('th_remarks')->nullable();
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
        Schema::dropIfExists('monitors');
    }
}
