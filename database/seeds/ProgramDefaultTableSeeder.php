<?php

use Illuminate\Database\Seeder;

class ProgramDefaultTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('program_default')->delete();
        
        \DB::table('program_default')->insert(array (
            0 => 
            array (
                'id' => 1,
                'property' => 'logo',
                'value' => 'images/logo.png',
                'value2' => NULL,
                'deletable' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'property' => 'site_name',
                'value' => 'Foster Grandparents Program',
                'value2' => NULL,
                'deletable' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'property' => 'site_title',
                'value' => NULL,
                'value2' => 'Foster Grandparents Program',
                'deletable' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 7,
                'property' => 'email',
                'value' => 'fostergrandparentsprogram@dw.com',
                'value2' => NULL,
                'deletable' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 8,
                'property' => 'address',
                'value' => 'Delaware',
                'value2' => NULL,
                'deletable' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 9,
                'property' => 'Description',
                'value' => NULL,
                'value2' => 'The field under validation must have a size matching the given value. For string data, value corresponds to the number of characters. For numeric data, value corresponds to a given integer value. For an array, size corresponds to the count of the array. For files, size corresponds to the file size in kilobytes.',
                'deletable' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}