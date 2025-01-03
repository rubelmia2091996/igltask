<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Make sure the seeder is correctly referenced and imported
        $this->call(CandidatePermissionsSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
