<?php

namespace Database\Seeders;

use App\Enums\SocialNetworksEnum;
use App\Models\SocialNetwork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SOCIAL_NETWORKS = [
            SocialNetworksEnum::FACEBOOK,
            SocialNetworksEnum::INSTAGRAM,
            SocialNetworksEnum::X_TWITTER,
            SocialNetworksEnum::TIKTOK,
            SocialNetworksEnum::YOUTUBE
        ];

        foreach ($SOCIAL_NETWORKS as $order => $network) {
            SocialNetwork::insert([
                'name' => $network,
                'order' => $order + 1
            ]);
        }
    }
}
