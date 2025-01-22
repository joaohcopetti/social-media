<?php

namespace Database\Seeders;

use App\Models\ProfileMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = Profile::all();

        foreach ($profiles as $profile) {
            $quantity = fake()->numberBetween(5, 15);

            ProfileMedia::factory()->count($quantity)->create([
                'profile_id' => $profile->id
            ]);
        }
    }
}
