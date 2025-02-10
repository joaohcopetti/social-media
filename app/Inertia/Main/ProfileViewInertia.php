<?php

namespace App\Inertia\Main;

use App\Models\Profile;
use Illuminate\Support\Collection;
use Inertia\Inertia;

class ProfileViewInertia
{
    public function render(Profile $profile, Collection $media)
    {
        return Inertia::render('main/profile/ProfileView', [
            'profile' => $profile->loadMissing(['socialNetworks']),
            'media' => $media
        ]);
    }
}
