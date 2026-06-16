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
    'name' => 'Akun Konsuli',
    'email' => 'mhs@test.com',
    'password' => bcrypt('password'),
    'role' => 'konsuli'
]);

User::create([
    'name' => 'Dr. Samudra',
    'email' => 'dosen@test.com',
    'password' => bcrypt('password'),
    'role' => 'konselor'
]);
    }
}
