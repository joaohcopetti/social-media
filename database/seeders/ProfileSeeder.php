<?php

namespace Database\Seeders;

use App\Enums\SocialNetworkEnum;
use App\Models\Profile;
use App\Models\SocialNetwork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProfileMedia;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = $this->seedProfiles();

        $this->seedProfileMedia($profiles);
        $this->seedProfileSocialNetworks($profiles);
    }

    private function seedProfiles()
    {
        $PROFILE_QUANTITY = fake()->numberBetween(10, 25);

        return Profile::factory()->count($PROFILE_QUANTITY)->create();
    }

    private function seedProfileMedia($profiles)
    {
        foreach ($profiles as $profile) {
            $quantity = fake()->numberBetween(5, 15);

            ProfileMedia::factory()->count($quantity)->create([
                'profile_id' => $profile->id
            ]);
        }
    }

    private function seedProfileSocialNetworks($profiles)
    {
        $profileNetworks = [];
        $socialNetworks = SocialNetworkEnum::values();

        foreach ($profiles as $profile) {
            $networks = fake()->randomElements(
                $socialNetworks,
                fake()->numberBetween(1, 5)
            );

            foreach ($networks as $network) {
                $profileNetworks[] = [
                    'profile_id' => $profile->id,
                    'name' => $network,
                    'url' => 'https://www.google.com'
                ];
            }
        }

        SocialNetwork::insert($profileNetworks);
    }
}
