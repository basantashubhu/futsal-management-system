<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'superAdmin',
                'label' => 'Super Admin',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'admin',
                'label' => 'Administration',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'supervisor',
                'label' => 'Supervisor',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 1,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2018-04-02 08:15:36',
                'updated_at' => '2018-04-02 08:15:36',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'director',
                'label' => 'Director',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 1,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-14 07:56:31',
                'updated_at' => '2019-03-14 07:56:31',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'manager',
                'label' => 'Manager',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 1,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-14 07:56:43',
                'updated_at' => '2019-03-14 07:56:43',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'volunteer',
                'label' => 'Volunteer',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 1,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-14 07:57:18',
                'updated_at' => '2019-03-14 07:57:18',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'fiscal',
                'label' => 'Fiscal',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 1,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-03-14 07:57:28',
                'updated_at' => '2019-03-14 07:57:28',
            ),
        ));
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}