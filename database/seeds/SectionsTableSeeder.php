<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sections')->delete();
        
        \DB::table('sections')->insert(array (
            0 => 
            array (
                'id' => 1,
                'section' => 'Volunteer',
                'desc' => 'Volunteer details section',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'section' => 'Stipend Period',
                'desc' => 'Stipend Period details section',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'section' => 'Validation',
                'desc' => 'Validation section',
                'created_at' => '2019-03-19 12:02:02',
                'updated_at' => '2019-03-19 12:02:02',
            ),
            3 => 
            array (
                'id' => 4,
                'section' => 'Testing',
                'desc' => 'section testing',
                'created_at' => '2019-03-19 14:16:50',
                'updated_at' => '2019-03-19 14:16:50',
            ),
            4 => 
            array (
                'id' => 5,
                'section' => 'TimeSheet',
                'desc' => 'Time-sheet section',
                'created_at' => '2019-03-21 08:04:36',
                'updated_at' => '2019-03-21 08:04:36',
            ),
            5 => 
            array (
                'id' => 6,
                'section' => 'Holiday',
                'desc' => 'Holiday Section',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'section' => 'StipendItem',
                'desc' => 'Stipend Item',
                'created_at' => '2019-03-26 07:49:17',
                'updated_at' => '2019-03-26 07:49:17',
            ),
            7 => 
            array (
                'id' => 8,
                'section' => 'State',
                'desc' => 'Location State',
                'created_at' => '2019-03-27 07:27:35',
                'updated_at' => '2019-03-27 07:27:35',
            ),
            8 => 
            array (
                'id' => 9,
                'section' => 'LocationRegion',
                'desc' => 'Location Region',
                'created_at' => '2019-03-27 07:29:46',
                'updated_at' => '2019-03-27 07:29:46',
            ),
            9 => 
            array (
                'id' => 10,
                'section' => 'LocationDistrict',
                'desc' => 'Location District Section',
                'created_at' => '2019-03-27 07:32:55',
                'updated_at' => '2019-03-27 07:32:55',
            ),
            10 => 
            array (
                'id' => 11,
                'section' => 'LocationCity',
                'desc' => 'Location City Section',
                'created_at' => '2019-03-27 07:34:26',
                'updated_at' => '2019-03-27 07:34:26',
            ),
            11 => 
            array (
                'id' => 12,
                'section' => 'LocationCounty',
                'desc' => 'Location County Section',
                'created_at' => '2019-03-27 07:35:25',
                'updated_at' => '2019-03-27 07:35:25',
            ),
            12 => 
            array (
                'id' => 13,
                'section' => 'FinanceCode',
                'desc' => 'Finance Code',
                'created_at' => '2019-03-28 12:14:13',
                'updated_at' => '2019-03-28 12:14:13',
            ),
            13 => 
            array (
                'id' => 14,
                'section' => 'Site',
                'desc' => 'Site Type',
                'created_at' => '2019-03-28 12:14:13',
                'updated_at' => '2019-03-28 12:14:13',
            ),
        ));
        
        
    }
}