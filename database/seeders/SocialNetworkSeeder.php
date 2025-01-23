<?php

namespace Database\Seeders;

use App\Enums\SocialNetworkEnum;
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
            SocialNetworkEnum::FACEBOOK,
            SocialNetworkEnum::INSTAGRAM,
            SocialNetworkEnum::X_TWITTER,
            SocialNetworkEnum::TIKTOK,
            SocialNetworkEnum::YOUTUBE
        ];

        foreach ($SOCIAL_NETWORKS as $order => $network) {
            SocialNetwork::insert([
                'name' => $network,
                'order' => $order + 1
            ]);
        }
    }
}
