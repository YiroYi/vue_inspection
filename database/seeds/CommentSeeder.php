<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('comments')->insert([
        ["idfollowup"=> 1,"iduser"=>6,"content"=>"When does the loading will be performed?"],
        ["idfollowup"=> 2,"iduser"=>6,"content"=>"When does the CCI will be performed?"],
        ["idfollowup"=> 3,"iduser"=>6,"content"=>"When does the QCI will be performed?"],
        ["idfollowup"=> 4,"iduser"=>6,"content"=>"When does the SFA will be performed?"],
      ]);
    }
}
