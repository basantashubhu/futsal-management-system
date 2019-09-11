<?php

use Illuminate\Database\Seeder;

class EmailTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('email_templates')->delete();
        
        \DB::table('email_templates')->insert(array (
            0 => 
            array (
                'co_no' => 1,
                'created_at' => '2018-05-18 23:52:28',
                'deleted_at' => NULL,
                'id' => 1,
                'is_active' => 1,
                'is_default' => 1,
                'is_deleted' => 0,
                'section' => 'Template Section',
                'temp_code' => 'forgot_password',
                'temp_html' => '<p>{url}</p><p><br></p>
<a href="{url}"> Reset </a>',
                'temp_instruction' => NULL,
                'temp_json' => 'url:Link',
                'temp_name' => 'forgot_password',
                'temp_type' => 'Email',
                'updated_at' => '2018-05-28 16:57:13',
                'userc_id' => 5,
                'userd_id' => NULL,
                'useru_id' => 1,
            ),
            1 => 
            array (
                'co_no' => 1,
                'created_at' => '2019-07-10 14:05:05',
                'deleted_at' => NULL,
                'id' => 2,
                'is_active' => 1,
                'is_default' => 1,
                'is_deleted' => 0,
                'section' => 'Template Section',
                'temp_code' => 'timesheets_post_email',
            'temp_html' => '<p><span style="font-family: Arial;">Dear {first_name},</span><br></p><p><span style="font-family: Arial;">Timesheets have posted successfully for Period #{period_no}, for County(s) {counties}.</span></p><table class="table table-bordered" style="width: 500px;"><tbody><tr><td>Supervisor(s)</td><td>Period</td><td>Posting Date</td></tr><tr><td>{supervisor_list}</td></tr></tbody></table><p><br></p>',
                'temp_instruction' => '<p>This is an email template which is used to send the Excel file to the related person.</p>',
                'temp_json' => 'link:Link, last_name:Last Name,first_name:First Name,middle_name:Mid Name,period_no:Period No,counties: Counties,supervisor_list:Supervisors',
                'temp_name' => 'Timesheets Post Email',
                'temp_type' => 'Email',
                'updated_at' => '2019-07-12 13:54:21',
                'userc_id' => 19,
                'userd_id' => NULL,
                'useru_id' => 19,
            ),
        ));
        
        
    }
}