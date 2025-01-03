<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Get the admin role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Get all permissions for candidates and interviews
        $permissions = Permission::whereIn('name', [
            'candidates.index',
            'candidates.show',
            'candidates.create',
            'candidates.store',
            'candidates.edit',
            'candidates.update',
            'candidates.destroy',
            'candidates.hired',
            'candidates.rejected',
            'candidates.updateStatus',
            'candidates.scheduleInterviews',
            'candidates.showcandidate',
            'import.candidate',

            'interviews.upcoming',
            'interviews.downloadPhoneNumbers',
            'interviews.completed',
        ])->get();

        // Assign all permissions to the admin role
        $adminRole->givePermissionTo($permissions);

        // Create an admin user and assign the admin role (you can update the user creation part)
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'), // Use a secure password
            ]
        );

        $adminUser->assignRole('admin');
    }
}
