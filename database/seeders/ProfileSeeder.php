<?php

namespace Database\Seeders;

use App\Enums\SocialNetworksEnum;
use App\Models\Profile;
use App\Models\SocialNetwork;
use Illuminate\Database\Seeder;
use App\Models\ProfileMedia;
use Illuminate\Support\Facades\DB;

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

        $socialNetworks = SocialNetwork::all();

        foreach ($profiles as $profile) {
            $networks = fake()->randomElements(
                $socialNetworks->toArray(),
                fake()->numberBetween(1, 5)
            );

            foreach ($networks as $network) {
                $profileSocialNetworks[] = [
                    'profile_id' => $profile->id,
                    'social_network_id' => $network['id'],
                    'url' => $this->getSocialNetworkUrl($network['name'])
                ];
            }
        }

        DB::table('profile_social_network')->insert($profileSocialNetworks);
    }

    public function getSocialNetworkUrl($network)
    {
        return match ($network) {
            SocialNetworksEnum::FACEBOOK->value => 'https://www.facebook.com/username',
            SocialNetworksEnum::X_TWITTER->value => 'https://twitter.com/username',
            SocialNetworksEnum::INSTAGRAM->value => 'https://www.instagram.com/username/',
            SocialNetworksEnum::TIKTOK->value => 'https://www.tiktok.com/@username',
            SocialNetworksEnum::YOUTUBE->value => 'https://www.youtube.com/user/username'
        };
    }
}
