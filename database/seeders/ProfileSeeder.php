<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PROFILE_QUANTITY = fake()->numberBetween(10, 25);

        Profile::factory()->count($PROFILE_QUANTITY)->create();
    }
}
