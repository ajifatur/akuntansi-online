<?php

use Illuminate\Database\Seeder;
use App\Role;

class DummyRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['key' => 'admin', 'name' => 'Admin', 'is_admin' => 1],
            ['key' => 'member', 'name' => 'Member', 'is_admin' => 0],
        ];

        foreach($array as $key=>$data){
            Role::firstOrCreate(['key_role' => $data['key']], ['nama_role' => $data['name'], 'is_admin' => $data['is_admin'], 'role_at' => date('Y-m-d H:i:s')]);
        }
    }
}
