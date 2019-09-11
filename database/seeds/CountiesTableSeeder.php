<?php

use Illuminate\Database\Seeder;

class CountiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
         \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \DB::table('counties')->delete();
        
        \DB::table('counties')->insert(array (
            0 => 
            array (
                'id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'county_name' => 'New Castle 2',
                'description' => NULL,
                'county_code' => '',
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
            1 => 
            array (
                'id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'county_name' => 'Sussex',
                'description' => NULL,
                'county_code' => '',
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
            2 => 
            array (
                'id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'county_name' => 'Kent',
                'description' => NULL,
                'county_code' => '',
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
            3 => 
            array (
                'id' => 4,
                'region_id' => NULL,
                'state_id' => 2,
                'county_name' => 'New Castle 1',
                'description' => NULL,
                'county_code' => '',
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