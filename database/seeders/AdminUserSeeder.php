<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@elearn.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create Teacher Users
        User::create([
            'name' => 'John Smith',
            'email' => 'john@teacher.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah@teacher.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create Student Users
        User::create([
            'name' => 'Mike Wilson',
            'email' => 'mike@student.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Emily Davis',
            'email' => 'emily@student.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create additional test users
        User::factory(5)->create(['role' => 'teacher']);
        User::factory(20)->create(['role' => 'student']);
    }
}
