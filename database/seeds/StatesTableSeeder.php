<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \DB::table('states')->delete();
        
        \DB::table('states')->insert(array (
            0 => 
            array (
                'id' => 2,
                'state_name' => 'Delaware',
                'state_code' => '',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:16',
                'updated_at' => '2019-05-16 15:46:16',
            ),
        ));

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        
    }
}