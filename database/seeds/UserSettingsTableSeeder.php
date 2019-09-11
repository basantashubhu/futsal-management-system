<?php

use Illuminate\Database\Seeder;

class UserSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_settings')->delete();
        
        
        
    }
}