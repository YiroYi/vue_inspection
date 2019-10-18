<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtygentwodetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftygentwodetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddetail')->unsigned();
            $table->foreign('iddetail')->references('id')->on('inspdetails');
            $table->string('customer_country')->nullable();
            $table->string('factory_area_sqm2')->nullable();
            $table->string('company_owner')->nullable();
            $table->string('general_manager')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('export_license')->nullable();
            $table->string('nearest_port')->nullable();
            $table->string('bank_account_picture')->nullable();
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
        Schema::dropIfExists('ftygentwodetails');
    }
}
