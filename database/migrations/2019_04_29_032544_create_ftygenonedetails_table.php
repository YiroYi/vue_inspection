<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtygenonedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftygenonedetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->foreign('iddetail')->references('id')->on('inspdetails');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_position')->nullable();
            $table->string('main_product')->nullable();
            $table->string('main_market')->nullable();
            $table->string('production_capacity')->nullable();
            $table->string('registration_date')->nullable();
            $table->string('type_of_registration')->nullable();
            $table->string('type_of_company')->nullable();
            $table->integer('employees_number')->nullable();
            
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
        Schema::dropIfExists('ftygenonedetails');
    }
}
