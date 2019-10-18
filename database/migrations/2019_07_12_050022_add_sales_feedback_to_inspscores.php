<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalesFeedbackToInspscores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('inspscores', function (Blueprint $table) {

            $table->string('insp_grade')->nullable();
            $table->string('insp_remark')->nullable();
            $table->string('insp_ev')->nullable();
            $table->string('cs_grade')->nullable();
            $table->string('cs_remark')->nullable();
            $table->string('report_grade')->nullable();
            $table->string('report_remark')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      $table->string('insp_grade')->nullable();
      $table->string('insp_remark')->nullable();
      $table->string('insp_ev')->nullable();
      $table->string('cs_grade')->nullable();
      $table->string('cs_remark')->nullable();
      $table->string('report_grade')->nullable();
      $table->string('report_remark')->nullable();
    }
}
