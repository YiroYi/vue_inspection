<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspdetails', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('idservice')->unsigned();
          $table->foreign('idservice')->references('id')->on('services')->onDelete('cascade');
          $table->integer('iduser')->unsigned();
          $table->foreign('iduser')->references('id')->on('users');
          $table->string('inspector');
          $table->string('inspector_type');
          $table->string('cost_type');
          $table->longText('sup_intructions');
          $table->decimal('fee',9,2)->nullable();
          $table->boolean('status')->default(1);
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
        Schema::dropIfExists('inspdetails');
    }
}
