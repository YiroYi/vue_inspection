<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsCciactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('cciactions', function (Blueprint $table) {
            $table->string('container_damaged')->nullable();
            $table->boolean('pallets_loaded')->nullable();
            $table->string('packing_listPh')->nullable();
            $table->string('ack_Ph')->nullable();
            $table->string('c1ack_Ph')->nullable();
            $table->string('c2ack_Ph')->nullable();
            $table->string('count_ck_Ph')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('cciactions', function (Blueprint $table) {
            $table->string('container_damaged')->nullable();
            $table->boolean('pallets_loaded')->nullable();
            $table->string('packing_listPh')->nullable();
            $table->string('ack_Ph')->nullable();
            $table->string('c1ack_Ph')->nullable();
            $table->string('c2ack_Ph')->nullable();
            $table->string('count_ck_Ph')->nullable();
      });
    }
}
