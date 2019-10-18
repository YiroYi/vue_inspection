<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
          $table->string('contact_person')->nullable();
          $table->string('customer_mail')->nullable();
          $table->string('country')->nullable();
          $table->boolean('internal_external')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
          $table->string('contact_person')->nullable();
          $table->string('customer_mail')->nullable();
          $table->string('country')->nullable();
          $table->boolean('internal_external')->nullable();
        });
    }
}
