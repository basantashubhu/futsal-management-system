<?php

use Illuminate\Database\Seeder;

class LayoutBuilderSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('builder_setting')->insert([
            'setting_label' => 'layout_type',
            'setting_values' => '{"fluid": "","boxed": ""}',
            'default_value' => 'fluid',
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'page_background',
            'setting_values' => '{"lightgray": "","white": ""',
            'default_value' => 'lightgray',
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'desktop_fixed_header',
            'setting_values' => '{"on": "", "off": ""}',
            'default_value' => "on",
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'desktop_header_minimize_mode',
            'setting_values' => '{"none": "","hide":""}',
            'default_value' => 'none',
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'mobile_fixed_header',
            'setting_values' => '{"on":"", "off":""}',
            'default_value' => "on",
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'display_header_menu',
            'setting_values' => '{"on":"", "off":""}',
            'default_value' => "on",
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'dropdown_skin',
            'setting_values' => '{"light","dark"}',
            'default_value' => 'light',
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'display_submenu_arrow',
            'setting_values' => '{"on": "", "off": ""}',
            'default_value' => "on",
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'aside_skin',
            'setting_values' => '{"light":"","dark":""}',
            'default_value' => 'dark',
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'fixed_aside',
            'setting_values' => '{"on":"", "off":""}',
            'default_value' => "on",
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'allow_aside_minimizing',
            'setting_values' => '{"on":"", "off":""}',
            'default_value' => "off",
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'default_minimized_aside',
            'setting_values' => '{"on":"", "off":""}',
            'default_value' => "off",
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'default_hidden_aside',
            'setting_values' => '{"on":"", "off":""}',
            'default_value' => "off",
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'fixed_footer',
            'setting_values' => '{"on":"", "off":""}',
            'default_value' => "off",
        ]);

        DB::table('builder_setting')->insert([
            'setting_label' => 'global_page_background',
            'setting_values' => '{"lightyellow":"","darkblue":"","lightgray":""}',
            'default_value' => "none",
        ]);
    }
}
