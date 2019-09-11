<?php

use Illuminate\Database\Seeder;

class DeveloperNotesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('developer_notes')->delete();
        
        
        
    }
}