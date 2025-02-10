<?php

namespace App\Inertia\Panel;

use App\Models\Profile;
use Inertia\Inertia;

class ProfilesEditViewInertia
{
    public function render(Profile $profile)
    {
        return Inertia::render('panel/profiles/ProfilesEditView', [
            'profile' => $profile->loadMissing(['socialNetworks', 'user'])
        ]);
    }
}
