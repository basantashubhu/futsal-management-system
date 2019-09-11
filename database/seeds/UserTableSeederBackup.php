<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UserTableSeederBackup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('clients')->delete();

        $user = User::create([
            'name' => 'zeus',
            'email' => 'zeus@zeuslogic.com',
            'role_id' => 1,
            'password' => bcrypt('datatrax@1')
        ]);
        $user1 = User::create([
            'name' => 'troche',
            'email' => 'troche@zeuslogic.com',
            'role_id' => 1,
            'password' => bcrypt('troche@1')
        ]);

        $user3 = User::create([
            'name' => 'sthapa',
            'email' => 'sthapa@zeuslogic.com',
            'role_id' => 4,
            'password' => bcrypt('sthapa@1')
        ]);
        $user5 =  User::create([
            'name' => 'diana',
            'email' => 'diana@zeuslogic.com',
            'role_id' => 1,
            'password' => bcrypt('diana@1')
        ]);
        $user6 =  User::create([
            'name' => 'shiva',
            'email' => 'shiva@datatrax.net',
            'role_id' => 1,
            'password' => bcrypt('shiva@1')
        ]);
        $user7 =  User::create([
            'name' => 'prabhat',
            'email' => 'prabhat@datatrax.net',
            'role_id' => 1,
            'password' => bcrypt('prabhat@1')
        ]);
        $user9 = User::create([
            'name' => 'msymolon',
            'email' => 'msymolon@datatrax.net',
            'role_id' => 1,
            'password' => bcrypt('msymolon@1')
        ]);



        \DB::table('clients')->insert(array (
            0 =>
                array (
                    'alt_id' => NULL,
                    'title' => 'Mr',
                    'fname' => 'kancha',
                    'mname' => NULL,
                    'lname' => 'Wagley',
                    'dob' => '0000-00-00',
                    'org_id' => NULL,
                    'ssn' => 'eyJpdiI6IndFaElDSTFYOHRFNU5idEt5SVJBN3c9PSIsInZhbHVlIjoieTh2eUlIcjdUbWFNTnVLbkl1bnY3VHZXTUxcL3ZnUDJFMXJyTkpGOXpcL0xGOWdQTVoxREtWWldMMmpWRWJyQjMrSHYzSzRpcXlTS1F2VUdxOHZhT0pnN2laNEVvN0dTd2dUbnp',
                    'user_id' => $user->id,
                    'is_exportable' => 1,
                    'is_searchable' => 1,
                    'external_id' => NULL,
                    'external_api_id' => NULL,
                    'comments' => NULL,
                    'co_no' => 1,
                    'is_deleted' => 0,
                    'is_active' => 1,
                    'userc_id' => 1,
                    'useru_id' => 1,
                    'userd_id' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => '2018-04-12 03:20:17',
                    'updated_at' => '2018-04-12 09:45:03',
                ),
            1 =>
                array (
                    'alt_id' => NULL,
                    'title' => 'Mr',
                    'fname' => 'Tom',
                    'mname' => NULL,
                    'lname' => 'Roche',
                    'dob' => '0000-00-00',
                    'org_id' => 1,
                    'ssn' => 'eyJpdiI6IndFaElDSTFYOHRFNU5idEt5SVJBN3c9PSIsInZhbHVlIjoieTh2eUlIcjdUbWFNTnVLbkl1bnY3VHZXTUxcL3ZnUDJFMXJyTkpGOXpcL0xGOWdQTVoxREtWWldMMmpWRWJyQjMrSHYzSzRpcXlTS1F2VUdxOHZhT0pnN2laNEVvN0dTd2dUbnp',
                    'user_id' => $user1->id,
                    'is_exportable' => 1,
                    'is_searchable' => 1,
                    'external_id' => NULL,
                    'external_api_id' => NULL,
                    'comments' => NULL,
                    'co_no' => 1,
                    'is_deleted' => 0,
                    'is_active' => 1,
                    'userc_id' => 1,
                    'useru_id' => 1,
                    'userd_id' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => '2018-04-12 03:20:17',
                    'updated_at' => '2018-04-12 09:45:03',
                ),
            2 =>
                array (
                    'alt_id' => NULL,
                    'title' => 'Mr',
                    'fname' => 'Suman',
                    'mname' => NULL,
                    'lname' => 'Thapa',
                    'dob' => '0000-00-00',
                    'org_id' => NULL,
                    'ssn' => 'eyJpdiI6IndFaElDSTFYOHRFNU5idEt5SVJBN3c9PSIsInZhbHVlIjoieTh2eUlIcjdUbWFNTnVLbkl1bnY3VHZXTUxcL3ZnUDJFMXJyTkpGOXpcL0xGOWdQTVoxREtWWldMMmpWRWJyQjMrSHYzSzRpcXlTS1F2VUdxOHZhT0pnN2laNEVvN0dTd2dUbnp',
                    'user_id' => $user2->id,
                    'is_exportable' => 1,
                    'is_searchable' => 1,
                    'external_id' => NULL,
                    'external_api_id' => NULL,
                    'comments' => NULL,
                    'co_no' => 1,
                    'is_deleted' => 0,
                    'is_active' => 1,
                    'userc_id' => 1,
                    'useru_id' => 1,
                    'userd_id' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => '2018-04-12 03:20:17',
                    'updated_at' => '2018-04-12 09:45:03',
                ),
            3 =>
                array (
                    'alt_id' => NULL,
                    'title' => 'Mr',
                    'fname' => 'Suman',
                    'mname' => NULL,
                    'lname' => 'Thapa',
                    'dob' => '0000-00-00',
                    'org_id' => 1,
                    'ssn' => 'eyJpdiI6IndFaElDSTFYOHRFNU5idEt5SVJBN3c9PSIsInZhbHVlIjoieTh2eUlIcjdUbWFNTnVLbkl1bnY3VHZXTUxcL3ZnUDJFMXJyTkpGOXpcL0xGOWdQTVoxREtWWldMMmpWRWJyQjMrSHYzSzRpcXlTS1F2VUdxOHZhT0pnN2laNEVvN0dTd2dUbnp',
                    'user_id' => $user3->id,
                    'is_exportable' => 1,
                    'is_searchable' => 1,
                    'external_id' => NULL,
                    'external_api_id' => NULL,
                    'comments' => NULL,
                    'co_no' => 1,
                    'is_deleted' => 0,
                    'is_active' => 1,
                    'userc_id' => 1,
                    'useru_id' => 1,
                    'userd_id' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => '2018-04-12 03:20:17',
                    'updated_at' => '2018-04-12 09:45:03',
                ),
            4 =>
                array (
                    'alt_id' => NULL,
                    'title' => 'Mr',
                    'fname' => 'Kiran',
                    'mname' => NULL,
                    'lname' => 'Chaulagain',
                    'dob' => '1997-10-28',
                    'org_id' => NULL,
                    'ssn' => 'eyJpdiI6ImZ5UDZBQzFWeXNGcUJQQWU0QmlWNXc9PSIsInZhbHVlIjoiVm1pQmhBbG55MWxDT1VSNkl0Y2dNcVB3eTc4aUV0SWRFVGJPdGFoTFwvTTlKMFl2c2grRjJyS1Y1SUVXM3BmSGNpbVZ1djNMdFp5QURkSU1tcE5udndYUldxVFN0eWNzWXBadEh',
                    'user_id' => $user4->id,
                    'is_exportable' => 1,
                    'is_searchable' => 1,
                    'external_id' => NULL,
                    'external_api_id' => NULL,
                    'comments' => NULL,
                    'co_no' => 1,
                    'is_deleted' => 0,
                    'is_active' => 1,
                    'userc_id' => 1,
                    'useru_id' => NULL,
                    'userd_id' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => '2018-04-25 11:47:14',
                    'updated_at' => '2018-04-25 11:47:14',
                ),
            5 =>
                array (
                    'alt_id' => NULL,
                    'title' => 'Mr',
                    'fname' => 'Diana',
                    'mname' => NULL,
                    'lname' => 'Barbieri',
                    'dob' => '1996-06-11',
                    'org_id' => NULL,
                    'ssn' => 'eyJpdiI6IklLZVdKN0F4aGNuSVkySGl3ZDhNQ1E9PSIsInZhbHVlIjoiY2prK2I2alY1YzE4eEdZRERYTVZ6Nmh5UDlWUnJYTDJIMlFcL3Q0RkM4eFY4NTFIaDNmNW5HU0xudjNWSDIyaE96M3BGU1VkcStyS3NWSWphK3NtXC81YzgwbUlybDMxSWZUUjh',
                    'user_id' => $user5->id,
                    'is_exportable' => 1,
                    'is_searchable' => 1,
                    'external_id' => NULL,
                    'external_api_id' => NULL,
                    'comments' => NULL,
                    'co_no' => 1,
                    'is_deleted' => 0,
                    'is_active' => 1,
                    'userc_id' => 1,
                    'useru_id' => NULL,
                    'userd_id' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => '2018-04-25 12:01:11',
                    'updated_at' => '2018-04-25 12:01:11',
                ),
            6 =>
                array (
                    'alt_id' => NULL,
                    'title' => 'Mr',
                    'fname' => 'Shiva',
                    'mname' => NULL,
                    'lname' => 'Thapa',
                    'dob' => '0009-07-10',
                    'org_id' => NULL,
                    'ssn' => 'eyJpdiI6IlYyWTBzOWk0ZFUrR0tYMG5Gd0Nwb2c9PSIsInZhbHVlIjoiTWNYNnZxRE9hVTRtcUZXdW4rRVMzZE9iNmw2OFJMemNBdVBOa2dEa2pjemtNdkdSamVzVkZSVzhrYXI4Z2g5RWk3c0pKSXJ0bHJ4Vnp5NkdaR1lDU2RKdUFLM2pVeWN4Ync2UDJ',
                    'user_id' => $user6->id,
                    'is_exportable' => 1,
                    'is_searchable' => 1,
                    'external_id' => NULL,
                    'external_api_id' => NULL,
                    'comments' => NULL,
                    'co_no' => 1,
                    'is_deleted' => 0,
                    'is_active' => 1,
                    'userc_id' => 1,
                    'useru_id' => NULL,
                    'userd_id' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => '2018-04-25 12:01:52',
                    'updated_at' => '2018-04-25 12:01:52',
                ),
            7 =>
                array (
                    'alt_id' => NULL,
                    'title' => 'Mr',
                    'fname' => 'Prabhat',
                    'mname' => NULL,
                    'lname' => 'Gurung',
                    'dob' => '0000-00-00',
                    'org_id' => NULL,
                    'ssn' => 'eyJpdiI6Ik1rVmEwWmRWMDNTMzZSalNhUHE4THc9PSIsInZhbHVlIjoiV0pmSHlTc0c3RGRyN0dQZ2hudUEwUlJiS1lrZTRcL0xBMkN0YnVqZnFrdHVQa3doejVLZUxyQmJ4U3N4cnFnSVl1ZnRnV044RU5CdHVoYjdzYjBqRDQxcFduUmxKN1J6QzZBNm1',
                    'user_id' => $user7->id,
                    'is_exportable' => 1,
                    'is_searchable' => 1,
                    'external_id' => NULL,
                    'external_api_id' => NULL,
                    'comments' => NULL,
                    'co_no' => 1,
                    'is_deleted' => 0,
                    'is_active' => 1,
                    'userc_id' => 1,
                    'useru_id' => NULL,
                    'userd_id' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => '2018-04-25 12:02:36',
                    'updated_at' => '2018-04-25 12:02:36',
                ),
            8 =>
                array (
                    'alt_id' => NULL,
                    'title' => 'Mr',
                    'fname' => 'Rabin',
                    'mname' => NULL,
                    'lname' => 'Bhandari',
                    'dob' => '0000-00-00',
                    'org_id' => NULL,
                    'ssn' => 'eyJpdiI6IitUXC9BMXUyVjZJXC9DYmt3U2VRdXRYZz09IiwidmFsdWUiOiJDZXZESThQdTQ3Q1dvWjBuNVFSMjZnTGk3NEVFVUN2TlI2ZTdwWHdQUmJMXC8wOXErVUZBWTduNUZCcjNvSndrMGZMdTFGREtlXC9yUnBmYUIzamMzdmZRQStMdXdCbVRya3N',
                    'user_id' => $user8->id,
                    'is_exportable' => 1,
                    'is_searchable' => 1,
                    'external_id' => NULL,
                    'external_api_id' => NULL,
                    'comments' => NULL,
                    'co_no' => 1,
                    'is_deleted' => 0,
                    'is_active' => 1,
                    'userc_id' => 1,
                    'useru_id' => NULL,
                    'userd_id' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => '2018-04-25 12:03:05',
                    'updated_at' => '2018-04-25 12:03:05',
                ),
            9 =>
                array (
                    'alt_id' => NULL,
                    'title' => 'Mr',
                    'fname' => 'Micheal',
                    'mname' => NULL,
                    'lname' => 'Symolon',
                    'dob' => '0000-00-00',
                    'org_id' => NULL,
                    'ssn' => 'eyJpdiI6IitUXC9BMXUyVjZJXC9DYmt3U2VRdXRYZz09IiwidmFsdWUiOiJDZXZESThQdTQ3Q1dvWjBuNVFSMjZnTGk3NEVFVUN2TlI2ZTdwWHdQUmJMXC8wOXErVUZBWTduNUZCcjNvSndrMGZMdTFGREtlXC9yUnBmYUIzamMzdmZRQStMdXdCbVRya3N',
                    'user_id' => $user9->id,
                    'is_exportable' => 1,
                    'is_searchable' => 1,
                    'external_id' => NULL,
                    'external_api_id' => NULL,
                    'comments' => NULL,
                    'co_no' => 1,
                    'is_deleted' => 0,
                    'is_active' => 1,
                    'userc_id' => 1,
                    'useru_id' => NULL,
                    'userd_id' => NULL,
                    'deleted_at' => NULL,
                    'created_at' => '2018-04-25 12:03:05',
                    'updated_at' => '2018-04-25 12:03:05',
                ),

        ));

    }
}
