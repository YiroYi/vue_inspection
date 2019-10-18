<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropIdserviceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('followups', function($table) {
        $table->dropForeign('followups_idservice_foreign');
        $table->dropColumn('idservice');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('followups', function($table) {
      $table->dropForeign('followups_idservice_foreign');
      $table->dropColumn('idservice');
      });
    }
}
