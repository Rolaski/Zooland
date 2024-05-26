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
        User::create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@admin.com',
            'avatar' => 'admin.jpg',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'Jacob',
            'surname' => 'Jacobowski',
            'email' => 'jacob@gmail.com',
            'avatar' => 'jacob.jpg',
            'email_verified_at' => now(),
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

    }
}
