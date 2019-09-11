<?php

use Illuminate\Database\Seeder;

class EmailSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('email_settings')->delete();
        
        \DB::table('email_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'email' => 'prabhatgrg778@gmail.com',
                'email_from' => 'prabhatgrg778@gmail.com',
                'server' => 'smtp.gmail.com',
                'password' => 'Khot1980',
                'mail_type' => 'imap',
                'is_auth_required' => 1,
                'is_ssl' => 0,
                'is_tls' => 1,
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-04-12 07:33:29',
                'updated_at' => '2019-04-12 07:33:29',
            ),
        ));
        
        
    }
}