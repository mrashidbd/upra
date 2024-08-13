<?php

namespace Database\Seeders;

use App\Models\PersonalInformation;
use App\Models\ShareInformation;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 50 users with personal information and 1-3 share information entries each
        User::factory(50)->create()->each(function ($user) {
            PersonalInformation::factory()->create(['user_id' => $user->id]);
            ShareInformation::factory(rand(1, 3))->create(['user_id' => $user->id]);
        });

        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }

}
