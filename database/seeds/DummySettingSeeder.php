<?php

use Illuminate\Database\Seeder;
use App\Setting;

class DummySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            // General
            ['key' => 'site.name', 'name' => 'Nama Website', 'value' => 'FPM', 'category' => kategori_setting('general'), 'rules' => 'required'],
            ['key' => 'site.tagline', 'name' => 'Tagline', 'value' => 'Fatur Package Manager', 'category' => kategori_setting('general'), 'rules' => ''],

            // Color
            ['key' => 'site.color.primary_dark', 'name' => 'Warna Primer (Dark)', 'value' => '#dcb722', 'category' => kategori_setting('color'), 'rules' => 'required'], // Gold
            ['key' => 'site.color.primary_light', 'name' => 'Warna Primer (Light)', 'value' => '#faf5df', 'category' => kategori_setting('color'), 'rules' => 'required'],
            ['key' => 'site.color.secondary_dark', 'name' => 'Warna Sekunder (Dark)', 'value' => '#2181db', 'category' => kategori_setting('color'), 'rules' => 'required'], // Azure
            ['key' => 'site.color.secondary_light', 'name' => 'Warna Sekunder (Light)', 'value' => '#dfedfa', 'category' => kategori_setting('color'), 'rules' => 'required'],

            // View
            ['key' => 'site.view.login', 'name' => 'View Login', 'value' => 'login', 'category' => kategori_setting('view'), 'rules' => 'required'],
            ['key' => 'site.view.register', 'name' => 'View Register', 'value' => 'register', 'category' => kategori_setting('view'), 'rules' => 'required'],
            ['key' => 'site.view.forgot_password', 'name' => 'View Forgot Password', 'value' => 'forgot-password', 'category' => kategori_setting('view'), 'rules' => 'required'],

            // Logo
            ['key' => 'site.logo', 'name' => 'Logo', 'value' => '', 'category' => kategori_setting('logo'), 'rules' => ''],

            // Icon
            ['key' => 'site.icon', 'name' => 'Icon', 'value' => '', 'category' => kategori_setting('icon'), 'rules' => ''],
        ];

        foreach($array as $key=>$data){
            Setting::firstOrCreate(['setting_key' => $data['key']], ['setting_name' => $data['name'], 'setting_value' => $data['value'], 'setting_category' => $data['category'], 'setting_rules' => $data['rules'], 'setting_order' => ($key+1)]);
        }
    }
}
