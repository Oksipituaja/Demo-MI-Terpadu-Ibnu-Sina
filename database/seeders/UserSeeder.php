<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        User::firstOrCreate(
            ['email' => 'superadmin@school.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password123'),
                'role' => UserRole::SuperAdmin,
                'is_active' => true,
            ]
        );

        // Create Admin
        User::firstOrCreate(
            ['email' => 'admin@school.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'role' => UserRole::Admin,
                'is_active' => true,
            ]
        );

        // Create regular user (converted to Admin role)
        User::firstOrCreate(
            ['email' => 'user@school.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password123'),
                'role' => UserRole::Admin,
                'is_active' => true,
            ]
        );

        // Create more sample users
        User::factory()->count(5)->create([
            'role' => UserRole::Admin,
            'is_active' => true,
        ]);
    }
}
