<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'npp' => '234567',
            'name' => 'Admin Aplikasi',
            'level' => 'admin',
            'jabatan' => 'Pelaksana',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'foto' => 'avatar5.png',
        ]);
        User::create([
            'npp' => '123456',
            'name' => 'Karyawan',
            'level' => 'karyawan',
            'jabatan' => 'Pelaksana',
            'email' => 'karyawan@gmail.com',
            'password' => bcrypt('password'),
            'foto' => 'avatar5.png',
        ]);
    }
}
