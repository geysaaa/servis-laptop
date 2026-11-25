<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    User::create([
        'name' => 'Admin Toko',
        'email' => 'admin@servis.test',
        'password' => 'password123',
        'peran' => 'admin',
    ]);

    User::create([
        'name' => 'Petugas Toko',
        'email' => 'petugas@servis.test',
        'password' => 'password123',
        'peran' => 'petugas',
    ]);
}
}
