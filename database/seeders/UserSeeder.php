<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@cinemaapp.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@cinemaapp.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
    }
}
