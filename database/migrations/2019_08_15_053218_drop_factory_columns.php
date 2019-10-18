<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropFactoryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ftyonequestions', function (Blueprint $table) {
          $table->dropColumn('img1Pa');
          $table->dropColumn('img2Pa');
          $table->dropColumn('img1Ce');
          $table->dropColumn('img2Ce');

      });

      Schema::table('ftytwoquestions', function (Blueprint $table) {
        $table->dropColumn('img1Plm');
        $table->dropColumn('img2Plm');
        $table->dropColumn('img1Mp');
        $table->dropColumn('img2Mp');

      });

      Schema::table('ftythreequestions', function (Blueprint $table) {
        $table->dropColumn('img1Iin');
        $table->dropColumn('img2Iin');
        $table->dropColumn('img1Qm');
        $table->dropColumn('img2Qm');

      });

      Schema::table('ftyfourquestions', function (Blueprint $table) {
        $table->dropColumn('img1Fi');
        $table->dropColumn('img2Fi');
        $table->dropColumn('img1Wh');
        $table->dropColumn('img2Wh');

      });

      Schema::table('ftyfivequestions', function (Blueprint $table) {
        $table->dropColumn('img1Ef');
        $table->dropColumn('img2Ef');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('ftyonequestions', function (Blueprint $table) {
          $table->dropColumn('img1Pa');
          $table->dropColumn('img2Pa');
          $table->dropColumn('img1Ce');
          $table->dropColumn('img2Ce');

      });

      Schema::table('ftytwoquestions', function (Blueprint $table) {
        $table->dropColumn('img1Plm');
        $table->dropColumn('img2Plm');
        $table->dropColumn('img1Mp');
        $table->dropColumn('img2Mp');

      });

      Schema::table('ftythreequestions', function (Blueprint $table) {
        $table->dropColumn('img1Iin');
        $table->dropColumn('img2Iin');
        $table->dropColumn('img1Qm');
        $table->dropColumn('img2Qm');

      });

      Schema::table('ftyfourquestions', function (Blueprint $table) {
        $table->dropColumn('img1Fi');
        $table->dropColumn('img2Fi');
        $table->dropColumn('img1Wh');
        $table->dropColumn('img2Wh');

      });

      Schema::table('ftyfivequestions', function (Blueprint $table) {
        $table->dropColumn('img1Ef');
        $table->dropColumn('img2Ef');
      });
    }
}
