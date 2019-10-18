<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropIddetailRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ftygenonedetails', function($table) {
        $table->dropForeign('ftygenonedetails_iddetail_foreign');
      });

      Schema::table('ftygentwodetails', function($table) {
        $table->dropForeign('ftygentwodetails_iddetail_foreign');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('ftygenonedetails', function($table) {
        $table->dropForeign('ftygenonedetails_iddetail_foreign');
      });

      Schema::table('ftygentwodetails', function($table) {
        $table->dropForeign('ftygentwodetails_iddetail_foreign');
      });
    }
}
