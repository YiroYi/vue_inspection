<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropIduserRelatioAndColumnnOnCommentsttable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('comments', function($table) {
        $table->dropForeign('comments_iduser_foreign');
        $table->dropColumn('iduser');
        $table->dropForeign('comments_idfollowup_foreign');
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
      Schema::table('comments', function($table) {
        $table->dropForeign('comments_iduser_foreign');
        $table->dropColumn('iduser');
        $table->dropForeign('comments_idfollowup_foreign');
        $table->dropColumn('idfollowup');
      });
    }
}
