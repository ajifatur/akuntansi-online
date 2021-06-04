<?php

use Illuminate\Database\Seeder;
use App\KategoriSetting;

class DummyKategoriSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['kategori' => 'Umum', 'slug' => 'general', 'prefix' => 'site.'],
            ['kategori' => 'Warna', 'slug' => 'color', 'prefix' => 'site.color.'],
            ['kategori' => 'View', 'slug' => 'view', 'prefix' => 'site.view.'],
            ['kategori' => 'Logo', 'slug' => 'logo', 'prefix' => 'site.'],
            ['kategori' => 'Icon', 'slug' => 'icon', 'prefix' => 'site.'],
        ];

        foreach($array as $key=>$data){
            KategoriSetting::updateOrCreate(['kategori' => $data['kategori'], 'slug' => $data['slug']], ['prefix' => $data['prefix']]);
        }
    }
}
