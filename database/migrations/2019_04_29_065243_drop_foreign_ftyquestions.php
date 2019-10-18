<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignFtyquestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ftyonequestions', function($table) {
        $table->dropForeign('ftyonequestions_iddetail_foreign');
      });

      Schema::table('ftytwoquestions', function($table) {
        $table->dropForeign('ftytwoquestions_iddetail_foreign');
      });

      Schema::table('ftythreequestions', function($table) {
        $table->dropForeign('ftythreequestions_iddetail_foreign');
      });

      Schema::table('ftyfourquestions', function($table) {
        $table->dropForeign('ftyfourquestions_iddetail_foreign');
      });

      Schema::table('ftyfivequestions', function($table) {
        $table->dropForeign('ftyfivequestions_iddetail_foreign');
      });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('ftyonequestions', function($table) {
        $table->dropForeign('ftyonequestions_iddetail_foreign');
      });

      Schema::table('ftytwoquestions', function($table) {
        $table->dropForeign('ftytwoquestions_iddetail_foreign');
      });

      Schema::table('ftythreequestions', function($table) {
        $table->dropForeign('ftythreequestions_iddetail_foreign');
      });

      Schema::table('ftyfourquestions', function($table) {
        $table->dropForeign('ftyfourquestions_iddetail_foreign');
      });

      Schema::table('ftyfivequestions', function($table) {
        $table->dropForeign('ftyfivequestions_iddetail_foreign');
      });
    }
}
