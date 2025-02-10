<?php

namespace Database\Seeders;

use App\Enums\SocialNetworkEnum;
use App\Models\Profile;
use App\Models\SocialNetwork;
use DB;
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
        $PROFILE_QUANTITY = fake()->numberBetween(30, 100);

        return Profile::factory()->count($PROFILE_QUANTITY)->create();
    }

    public function seedProfileMedia($profiles)
    {
        foreach ($profiles as $index => $profile) {
            $quantity = fake()->numberBetween(5, 15);

            ProfileMedia::factory()->count($quantity)->create([
                'profile_id' => $profile->id,
                'order' => $index
            ]);
        }
    }

    public function seedProfileSocialNetworks($profiles)
    {
        $profileSocialNetworks = [];

        $socialNetworkIds = SocialNetwork::pluck('id');

        foreach ($profiles as $profile) {
            $networkIds = fake()->randomElements(
                $socialNetworkIds,
                fake()->numberBetween(1, 5)
            );

            foreach ($networkIds as $networkId) {
                $profileSocialNetworks[] = [
                    'profile_id' => $profile->id,
                    'social_network_id' => $networkId,
                    'url' => 'https://www.google.com'
                ];
            }
        }

        DB::table('profile_social_network')->insert($profileSocialNetworks);
    }
}
