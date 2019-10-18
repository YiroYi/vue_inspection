<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropIduserRelatioAndColumnnOnFollowuptable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('followups', function($table) {
        $table->dropForeign('followups_iduser_foreign');
        $table->dropColumn('iduser');
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
        $table->dropForeign('followups_iduser_foreign');
        $table->dropColumn('iduser');
      });
    }
}
