<?php

namespace App\Actions;

use App\Models\Profile;
use App\Models\SocialNetwork;

class ProfileSyncNetworksAction
{
    public function execute(Profile $profile, array $socialNetworksData): Profile
    {
        $data = [];
        $socialNetworks = SocialNetwork::all();

        foreach ($socialNetworks as $socialNetwork) {
            $url = $socialNetworksData[$socialNetwork->name];

            if ($url) {
                $data[$socialNetwork->id] = ['url' => $url];
            }
        }

        $profile->socialNetworks()->sync($data);

        return $profile;
    }
}
