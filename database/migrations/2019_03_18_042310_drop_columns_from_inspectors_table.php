<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsFromInspectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inspectors', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone', 'en_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspectors', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone', 'en_name']);
        });
    }
}
