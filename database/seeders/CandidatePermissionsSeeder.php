<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CandidatePermissionsSeeder extends Seeder
{
    public function run()
    {
        // Define permissions for candidates and interviews
        $permissions = [
            // Candidate Permissions
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

            // Interview Permissions
            'interviews.upcoming',
            'interviews.downloadPhoneNumbers',
            'interviews.completed',
        ];

        // Create the permissions
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }
    }
}
