<?php

use Illuminate\Database\Seeder;

class UserPermissionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('user_permission')->delete();
        
        \DB::table('user_permission')->insert(array (
            0 => 
            array (
                'id' => 24,
                'users_id' => 2,
                'permission_id' => 25,
                'created_at' => '2018-04-13 08:10:30',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 25,
                'users_id' => 2,
                'permission_id' => 4,
                'created_at' => '2018-04-13 08:10:30',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 26,
                'users_id' => 2,
                'permission_id' => 10,
                'created_at' => '2018-04-13 08:10:30',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 123,
                'users_id' => 9,
                'permission_id' => 23,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 124,
                'users_id' => 9,
                'permission_id' => 3,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 125,
                'users_id' => 9,
                'permission_id' => 25,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 126,
                'users_id' => 9,
                'permission_id' => 19,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 127,
                'users_id' => 9,
                'permission_id' => 30,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 128,
                'users_id' => 9,
                'permission_id' => 2,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 129,
                'users_id' => 9,
                'permission_id' => 28,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 130,
                'users_id' => 9,
                'permission_id' => 1,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 131,
                'users_id' => 9,
                'permission_id' => 16,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 132,
                'users_id' => 9,
                'permission_id' => 11,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 133,
                'users_id' => 9,
                'permission_id' => 29,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 134,
                'users_id' => 9,
                'permission_id' => 21,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 135,
                'users_id' => 9,
                'permission_id' => 6,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 136,
                'users_id' => 9,
                'permission_id' => 24,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 137,
                'users_id' => 9,
                'permission_id' => 4,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 138,
                'users_id' => 9,
                'permission_id' => 27,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 139,
                'users_id' => 9,
                'permission_id' => 5,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 140,
                'users_id' => 9,
                'permission_id' => 14,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 141,
                'users_id' => 9,
                'permission_id' => 15,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 142,
                'users_id' => 9,
                'permission_id' => 26,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 143,
                'users_id' => 9,
                'permission_id' => 22,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 144,
                'users_id' => 9,
                'permission_id' => 10,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 145,
                'users_id' => 9,
                'permission_id' => 9,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 146,
                'users_id' => 9,
                'permission_id' => 13,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 147,
                'users_id' => 9,
                'permission_id' => 12,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 148,
                'users_id' => 9,
                'permission_id' => 7,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 149,
                'users_id' => 9,
                'permission_id' => 18,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 150,
                'users_id' => 9,
                'permission_id' => 8,
                'created_at' => '2019-04-11 08:29:42',
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 151,
                'users_id' => 10,
                'permission_id' => 23,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 152,
                'users_id' => 10,
                'permission_id' => 3,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 153,
                'users_id' => 10,
                'permission_id' => 25,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 154,
                'users_id' => 10,
                'permission_id' => 19,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 155,
                'users_id' => 10,
                'permission_id' => 30,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 156,
                'users_id' => 10,
                'permission_id' => 2,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 157,
                'users_id' => 10,
                'permission_id' => 28,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 158,
                'users_id' => 10,
                'permission_id' => 1,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 159,
                'users_id' => 10,
                'permission_id' => 16,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 160,
                'users_id' => 10,
                'permission_id' => 11,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 161,
                'users_id' => 10,
                'permission_id' => 29,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 162,
                'users_id' => 10,
                'permission_id' => 21,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 163,
                'users_id' => 10,
                'permission_id' => 6,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 164,
                'users_id' => 10,
                'permission_id' => 24,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 165,
                'users_id' => 10,
                'permission_id' => 4,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 166,
                'users_id' => 10,
                'permission_id' => 27,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 167,
                'users_id' => 10,
                'permission_id' => 5,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 168,
                'users_id' => 10,
                'permission_id' => 14,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 169,
                'users_id' => 10,
                'permission_id' => 15,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 170,
                'users_id' => 10,
                'permission_id' => 26,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 171,
                'users_id' => 10,
                'permission_id' => 22,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 172,
                'users_id' => 10,
                'permission_id' => 10,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 173,
                'users_id' => 10,
                'permission_id' => 9,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 174,
                'users_id' => 10,
                'permission_id' => 13,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 175,
                'users_id' => 10,
                'permission_id' => 12,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 176,
                'users_id' => 10,
                'permission_id' => 7,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 177,
                'users_id' => 10,
                'permission_id' => 18,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 178,
                'users_id' => 10,
                'permission_id' => 8,
                'created_at' => '2019-04-11 08:29:50',
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 179,
                'users_id' => 8,
                'permission_id' => 23,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 180,
                'users_id' => 8,
                'permission_id' => 3,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 181,
                'users_id' => 8,
                'permission_id' => 25,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 182,
                'users_id' => 8,
                'permission_id' => 19,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 183,
                'users_id' => 8,
                'permission_id' => 30,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 184,
                'users_id' => 8,
                'permission_id' => 2,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 185,
                'users_id' => 8,
                'permission_id' => 28,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 186,
                'users_id' => 8,
                'permission_id' => 1,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 187,
                'users_id' => 8,
                'permission_id' => 16,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 188,
                'users_id' => 8,
                'permission_id' => 11,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 189,
                'users_id' => 8,
                'permission_id' => 29,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 190,
                'users_id' => 8,
                'permission_id' => 21,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 191,
                'users_id' => 8,
                'permission_id' => 6,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 192,
                'users_id' => 8,
                'permission_id' => 24,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 193,
                'users_id' => 8,
                'permission_id' => 4,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 194,
                'users_id' => 8,
                'permission_id' => 27,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 195,
                'users_id' => 8,
                'permission_id' => 5,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 196,
                'users_id' => 8,
                'permission_id' => 14,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 197,
                'users_id' => 8,
                'permission_id' => 15,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id' => 198,
                'users_id' => 8,
                'permission_id' => 26,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id' => 199,
                'users_id' => 8,
                'permission_id' => 22,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id' => 200,
                'users_id' => 8,
                'permission_id' => 10,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 201,
                'users_id' => 8,
                'permission_id' => 9,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 202,
                'users_id' => 8,
                'permission_id' => 13,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 203,
                'users_id' => 8,
                'permission_id' => 12,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 204,
                'users_id' => 8,
                'permission_id' => 7,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 205,
                'users_id' => 8,
                'permission_id' => 18,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id' => 206,
                'users_id' => 8,
                'permission_id' => 8,
                'created_at' => '2019-04-11 08:29:58',
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'id' => 236,
                'users_id' => 5,
                'permission_id' => 26,
                'created_at' => '2019-04-23 08:40:12',
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'id' => 288,
                'users_id' => 3,
                'permission_id' => 5,
                'created_at' => '2019-04-24 12:25:27',
                'updated_at' => NULL,
            ),
        ));
        
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}