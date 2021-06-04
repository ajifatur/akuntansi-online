<?php

use Illuminate\Database\Seeder;

class InstallDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DummyRoleSeeder::class);
        $this->call(DummyKategoriSettingSeeder::class);
        $this->call(DummySettingSeeder::class);
        $this->call(DummyUserSeeder::class);
    }
}
