<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveProveedoresRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('suppliers', function(Blueprint $table){
        $table->dropForeign('suppliers_id_foreign');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('suppliers', function(Blueprint $table){
        $table->dropForeign('suppliers_id_foreign');
        
      });
    }
}
