<?php

use Illuminate\Database\Seeder;

class ProgramTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('program')->delete();
        
        \DB::table('program')->insert(array (
            0 => 
            array (
                'id' => 1,
                'property' => 'email',
                'value' => 'fostergrandparentprogram@gmail.com',
                'value2' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'property' => 'address',
                'value' => 'Delaware State',
                'value2' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'property' => 'logo',
                'value' => 'images/logo.png',
                'value2' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}