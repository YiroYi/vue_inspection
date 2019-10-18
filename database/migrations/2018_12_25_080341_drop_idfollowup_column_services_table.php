<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropIdfollowupColumnServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('services', function($table) {
        $table->dropForeign('services_idfollowup_foreign');
        $table->dropColumn('idfollowup');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('services', function($table) {
        $table->dropForeign('services_idfollowup_foreign');
        $table->dropColumn('idfollowup');
      });
    }
}
