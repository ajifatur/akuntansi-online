<?php

use Illuminate\Database\Seeder;
use App\User;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check user with Admin access
        $count_admin = User::where('role','=',role('admin'))->count();

        // Create user account if $count_admin less than 1
        if($count_admin < 1){
            $user = new User;
            $user->nama_user = 'Admin';
            $user->email = 'admin@admin.com';
            $user->username = 'admin@admin.com';
            $user->password = bcrypt('password');
            $user->tanggal_lahir = date('Y-m-d');
            $user->jenis_kelamin = 'L';
            $user->nomor_hp = '081234567890';
            $user->foto = '';
            $user->role = role('admin');
            $user->is_admin = 1;
            $user->status = 1;
            $user->email_verified = 1;
            $user->last_visit = null;
            $user->register_at = date('Y-m-d H:i:s');
            $user->save();
        }
    }
}
