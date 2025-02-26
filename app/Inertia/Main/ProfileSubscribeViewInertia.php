<?php

namespace App\Inertia\Main;

use App\Models\Profile;
use Inertia\Inertia;

class ProfileSubscribeViewInertia
{
    public function render(Profile $profile)
    {
        return Inertia::render('main/profile/ProfileSubscribeView', [
            'profile' => $profile
        ]);
    }
}
