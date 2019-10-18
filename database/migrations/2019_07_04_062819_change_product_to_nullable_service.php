<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProductToNullableService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('services', function (Blueprint $table) {
            $table->string('container_type')->nullable()->change();
            $table->string('supplier_number')->nullable()->change();
            $table->string('sup_intructions')->nullable()->change();
            $table->string('product_type')->nullable()->change();

      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('services', function (Blueprint $table) {
            $table->string('container_type')->nullable()->change();
            $table->string('supplier_number')->nullable()->change();
            $table->string('sup_intructions')->nullable()->change();
            $table->string('product_type')->nullable()->change();
          
      });
    }
}
