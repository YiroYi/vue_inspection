<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idcategory')->unsigned();
            $table->integer('idforwarder')->unsigned();
            $table->integer('idsales')->unsigned();
            $table->integer('idcompany')->unsigned();
            $table->integer('idsupplier')->unsigned();
            $table->integer('idcustomer')->unsigned();
            $table->string('reference')->unique();
            $table->string('selling_price');
            $table->string('billing_price')->nullable();
            $table->string('product_type');
            $table->string('container_type');
            $table->string('item_number')->nullable();
            $table->string('cnts_cnts')->nullable();
            $table->string('spareparts_number')->nullable();
            $table->string('total_sp_cnts')->nullable();
            $table->string('po_number')->nullable();
            $table->string('supplier_number');
            $table->longText('instructions')->nullable();
            $table->boolean('special_instructions');
            $table->integer('inspection_status')->default(1);
            $table->date('inspection_date');
            $table->timestamps();

            $table->foreign('idcategory')->references('id')->on('categories');
            $table->foreign('idforwarder')->references('id')->on('forwarders');
            $table->foreign('idsales')->references('id')->on('users');
            $table->foreign('idcompany')->references('id')->on('companies');
            $table->foreign('idsupplier')->references('id')->on('suppliers');
            $table->foreign('idcustomer')->references('id')->on('customers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
