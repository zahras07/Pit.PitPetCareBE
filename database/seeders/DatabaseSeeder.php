<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'role' => 'Admin',
        ]);

        \App\Models\User::create([
            'name' => 'Jelni Oktavia Nengsih',
            'email' => 'jelnioktavia@gmail.com',
            'password' => '123456',
            'role' => 'Pelanggan',
        ]);

        \App\Models\User::create([
            'name' => 'Dea Nur Azizah',
            'email' => 'deanurazizah@gmail.com',
            'password' => '123456',
            'role' => 'Pelanggan',
        ]);
        
        \App\Models\User::create([
            'name' => 'Muhammad Ikhsan',
            'email' => 'mikhsan21@gmail.com',
            'password' => '123456',
            'role' => 'Pelanggan',
        ]);

        \App\Models\User::create([
            'name' => 'Wulan Anastasya Putri',
            'email' => 'wulann00@gmail.com',
            'password' => '123456',
            'role' => 'Pelanggan',
        ]);

        \App\Models\User::create([
            'name' => 'Muhammad Farhan',
            'email' => 'mhdfarhan2603@gmail.com',
            'password' => '123456',
            'role' => 'Pelanggan',
        ]);

        \App\Models\User::create([
            'name' => 'Agita Dewi Fortuna',
            'email' => 'agiitadp@gmail.com',
            'password' => '123456',
            'role' => 'Pelanggan',
        ]);
        
        \App\Models\User::create([
            'name' => 'Cindy Rahmi Putri',
            'email' => 'cindyrahmi21@gmail.com',
            'password' => '123456',
            'role' => 'Pelanggan',
        ]);
    }
}
