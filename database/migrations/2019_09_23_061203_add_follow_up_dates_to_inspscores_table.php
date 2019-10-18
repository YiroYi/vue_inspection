<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFollowUpDatesToInspscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inspscores', function (Blueprint $table) {
            $table->date('upload_db_date')->nullable();
            $table->date('upload_report_date')->nullable();
            $table->date('confirm_report_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::table('inspscores', function (Blueprint $table) {
              $table->date('upload_db_date')->nullable();
              $table->date('upload_report_date')->nullable();
              $table->date('confirm_report_date')->nullable();
          });
    }
}
