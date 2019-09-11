<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

         \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('districts')->delete();



        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        
        
    }
}