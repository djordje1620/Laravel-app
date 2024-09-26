<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('Lozinka234!'),
                'role_id' => 1,
            ],
            [
                'first_name' => 'Đorđe',
                'last_name' => 'Marković',
                'email' => 'djordje.markovic.16.20@ict.edu.rs',
                'password' => Hash::make('Lozinka123!'),
                'role_id' => 2,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
