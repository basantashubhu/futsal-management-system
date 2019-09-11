<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
		 \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('regions')->delete();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        
        
    }
}