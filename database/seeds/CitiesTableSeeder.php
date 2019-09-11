<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
         \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \DB::table('cities')->delete();
        
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'district_id' => NULL,
                'county_id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Wilmington',
                'city_code' => NULL,
                'zip_code' => '19806',
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
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Seaford',
                'city_code' => NULL,
                'zip_code' => '19973',
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
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Dover',
                'city_code' => NULL,
                'zip_code' => '19901',
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
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Bridgeville',
                'city_code' => NULL,
                'zip_code' => '19933',
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
            4 => 
            array (
                'id' => 5,
                'district_id' => NULL,
                'county_id' => 4,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'WILMINGTON',
                'city_code' => NULL,
                'zip_code' => '19801',
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
            5 => 
            array (
                'id' => 6,
                'district_id' => NULL,
                'county_id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Newark',
                'city_code' => NULL,
                'zip_code' => '19711',
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
            6 => 
            array (
                'id' => 7,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Laurel',
                'city_code' => NULL,
                'zip_code' => '19956',
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
            7 => 
            array (
                'id' => 8,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Camden',
                'city_code' => NULL,
                'zip_code' => '19934',
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
            8 => 
            array (
                'id' => 9,
                'district_id' => NULL,
                'county_id' => 4,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Wilmington',
                'city_code' => NULL,
                'zip_code' => '19805',
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
            9 => 
            array (
                'id' => 10,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Dover',
                'city_code' => NULL,
                'zip_code' => '19903',
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
            10 => 
            array (
                'id' => 11,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Smyrna',
                'city_code' => NULL,
                'zip_code' => '19977',
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
            11 => 
            array (
                'id' => 12,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Greenwood',
                'city_code' => NULL,
                'zip_code' => '19950',
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
            12 => 
            array (
                'id' => 13,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Felton',
                'city_code' => NULL,
                'zip_code' => '19943',
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
            13 => 
            array (
                'id' => 14,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Georgetown',
                'city_code' => NULL,
                'zip_code' => '19947',
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
            14 => 
            array (
                'id' => 15,
                'district_id' => NULL,
                'county_id' => 4,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Wilmington',
                'city_code' => NULL,
                'zip_code' => '19802',
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
            15 => 
            array (
                'id' => 16,
                'district_id' => NULL,
                'county_id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Newark',
                'city_code' => NULL,
                'zip_code' => '19702',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            16 => 
            array (
                'id' => 17,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Magnolia',
                'city_code' => NULL,
                'zip_code' => '19962',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            17 => 
            array (
                'id' => 18,
                'district_id' => NULL,
                'county_id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Wilmington',
                'city_code' => NULL,
                'zip_code' => '19808',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            18 => 
            array (
                'id' => 19,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Townsend',
                'city_code' => NULL,
                'zip_code' => '19934',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            19 => 
            array (
                'id' => 20,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Milford',
                'city_code' => NULL,
                'zip_code' => '19963',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            20 => 
            array (
                'id' => 21,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Dover',
                'city_code' => NULL,
                'zip_code' => '19904',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            21 => 
            array (
                'id' => 22,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Millsboro',
                'city_code' => NULL,
                'zip_code' => '19966',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            22 => 
            array (
                'id' => 23,
                'district_id' => NULL,
                'county_id' => 4,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'New Castle',
                'city_code' => NULL,
                'zip_code' => '19720',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            23 => 
            array (
                'id' => 24,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Frankford',
                'city_code' => NULL,
                'zip_code' => '19945',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            24 => 
            array (
                'id' => 25,
                'district_id' => NULL,
                'county_id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Claymont',
                'city_code' => NULL,
                'zip_code' => '19703',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            25 => 
            array (
                'id' => 26,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Lewes',
                'city_code' => NULL,
                'zip_code' => '19958',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            26 => 
            array (
                'id' => 27,
                'district_id' => NULL,
                'county_id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Wilmington',
                'city_code' => NULL,
                'zip_code' => '19804',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            27 => 
            array (
                'id' => 28,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Delmar',
                'city_code' => NULL,
                'zip_code' => '19940',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            28 => 
            array (
                'id' => 29,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Rehoboth',
                'city_code' => NULL,
                'zip_code' => '19971',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            29 => 
            array (
                'id' => 30,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Dover',
                'city_code' => NULL,
                'zip_code' => '19901-7524',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            30 => 
            array (
                'id' => 31,
                'district_id' => NULL,
                'county_id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Wilmington',
                'city_code' => NULL,
                'zip_code' => '19899',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            31 => 
            array (
                'id' => 32,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Camden-Wyoming',
                'city_code' => NULL,
                'zip_code' => '19934',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            32 => 
            array (
                'id' => 33,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Clayton',
                'city_code' => NULL,
                'zip_code' => '19938',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            33 => 
            array (
                'id' => 34,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Harrington',
                'city_code' => NULL,
                'zip_code' => '19952',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            34 => 
            array (
                'id' => 35,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Selbyville',
                'city_code' => NULL,
                'zip_code' => '19975',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            35 => 
            array (
                'id' => 36,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Bethel',
                'city_code' => NULL,
                'zip_code' => '19931',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            36 => 
            array (
                'id' => 37,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Lincoln',
                'city_code' => NULL,
                'zip_code' => '19960',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            37 => 
            array (
                'id' => 38,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Federica',
                'city_code' => NULL,
                'zip_code' => '19946',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:17',
                'updated_at' => '2019-05-16 15:46:17',
            ),
            38 => 
            array (
                'id' => 39,
                'district_id' => NULL,
                'county_id' => 4,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Bear',
                'city_code' => NULL,
                'zip_code' => '19701',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            39 => 
            array (
                'id' => 40,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Milton',
                'city_code' => NULL,
                'zip_code' => '19968',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            40 => 
            array (
                'id' => 41,
                'district_id' => NULL,
                'county_id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Wilmington',
                'city_code' => NULL,
                'zip_code' => '19809',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            41 => 
            array (
                'id' => 42,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Frederica',
                'city_code' => NULL,
                'zip_code' => '19946',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            42 => 
            array (
                'id' => 43,
                'district_id' => NULL,
                'county_id' => 4,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Townsend',
                'city_code' => NULL,
                'zip_code' => '19734',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            43 => 
            array (
                'id' => 44,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Dagsboro',
                'city_code' => NULL,
                'zip_code' => '19939',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            44 => 
            array (
                'id' => 45,
                'district_id' => NULL,
                'county_id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Newark',
                'city_code' => NULL,
                'zip_code' => '19713',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            45 => 
            array (
                'id' => 46,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Harley',
                'city_code' => NULL,
                'zip_code' => '19953',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            46 => 
            array (
                'id' => 47,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Harbeson',
                'city_code' => NULL,
                'zip_code' => '19951',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            47 => 
            array (
                'id' => 48,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Hartly',
                'city_code' => NULL,
                'zip_code' => '19953',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            48 => 
            array (
                'id' => 49,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Wyoming',
                'city_code' => NULL,
                'zip_code' => '19934',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            49 => 
            array (
                'id' => 50,
                'district_id' => NULL,
                'county_id' => 1,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Newark',
                'city_code' => NULL,
                'zip_code' => '1971',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            50 => 
            array (
                'id' => 51,
                'district_id' => NULL,
                'county_id' => 2,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Blades',
                'city_code' => NULL,
                'zip_code' => '19973',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            51 => 
            array (
                'id' => 52,
                'district_id' => NULL,
                'county_id' => 4,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Bear',
                'city_code' => NULL,
                'zip_code' => '19702',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
            52 => 
            array (
                'id' => 53,
                'district_id' => NULL,
                'county_id' => 3,
                'region_id' => NULL,
                'state_id' => 2,
                'city_name' => 'Demoines',
                'city_code' => NULL,
                'zip_code' => '19702',
                'co_no' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
                'userc_id' => 0,
                'useru_id' => NULL,
                'userd_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2019-05-16 15:46:18',
                'updated_at' => '2019-05-16 15:46:18',
            ),
        ));

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        
    }
}