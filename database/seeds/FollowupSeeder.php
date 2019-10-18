<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('followups')->insert([
          ["idservice"=> 1,"iduser"=>8,"content"=>"Follow up 1 the supplier has not answered"],
          ["idservice"=> 8,"iduser"=>8,"content"=>"Follow up 2 the supplier has not answered"],
          ["idservice"=> 9,"iduser"=>8,"content"=>"Follow up 3 the supplier has not answered"],
          ["idservice"=> 10,"iduser"=>8,"content"=>"Follow up 4 the supplier has not answered"],

        ]);
    }
}
