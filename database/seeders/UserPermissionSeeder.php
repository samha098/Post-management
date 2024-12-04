<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
    $adminRole = Role::firstOrCreate(['name' => 'Admin']);
    $userRole = Role::firstOrCreate(['name' => 'User']);

    // Create Permissions
    $permissions = ['create', 'read', 'update', 'delete'];
    
    $adminUser = User::where('email', 'admin@example.com')->first();
    foreach ($permissions as $permission) {
        $perm = Permission::firstOrCreate(['name' => $permission]);
        $adminUser->permissions()->attach($perm->id);
    
    }
}
}