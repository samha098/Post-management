<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@example.com'], // Check if the admin user already exists by email
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'), // Set the admin password
            ]
        );
        $adminRole = Role::firstOrCreate(
            ['name' => 'Admin'], // Check if the role exists by name
            ['name' => 'Admin'] // Create if not exists
        );
    
        // Attach the Admin role to the user
        $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);
    }
}