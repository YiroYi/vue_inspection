<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalColumnSupervisorInstructionsToServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('services', function (Blueprint $table) {
            $table->longText('sup_intructions')->nullable();
            $table->decimal('total_cost',9,2)->nullable();
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
            $table->longText('sup_intructions')->nullable();
            $table->decimal('total_cost',9,2)->nullable();
      });
    }
}
