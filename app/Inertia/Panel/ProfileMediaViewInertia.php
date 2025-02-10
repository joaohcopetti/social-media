<?php

namespace App\Inertia\Panel;

use App\Models\Profile;
use Inertia\Inertia;

class ProfileMediaViewInertia
{
    public function render(Profile $profile)
    {
        return Inertia::render('panel/media/ProfileMediaManagementView', [
            'profile' => $profile->loadMissing(['media' => fn($q) => $q->orderBy('order', 'asc')])
        ]);
    }
}
