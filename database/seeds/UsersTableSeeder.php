<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'alt_id' => NULL,
                'rpt_mgr_id' => NULL,
                'name' => 'dsc',
                'email' => 'support@zeuslogic.com',
                'password' => '$2y$10$dfwhepHDKfxjgTzAzn/JlObQe7agYCC2E9MZ.L74k/5Xm.Ycevo5u',
                'remember_token' => 'rDJx4OrvhbjeNkXcWoF4yoe80rcNxDFn1543FHX9ymbefABPSXrmIrmKBvHx',
                'role_id' => 1,
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'is_locked' => 0,
                'locked_at' => NULL,
                'locked_until' => NULL,
                'created_at' => '2019-03-11 08:17:34',
                'updated_at' => '2019-04-24 15:07:12',
            ),
            
        ));
        
    }
}