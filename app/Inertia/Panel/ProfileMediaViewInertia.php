<?php

namespace App\Inertia\Panel;

use App\Models\Profile;
use Inertia\Inertia;

class ProfileMediaViewInertia
{
    public function render(Profile $profile)
    {
        return Inertia::render('panel/media/ProfileMediaView', [
            'profile' => $profile->loadMissing([
                'media' => fn($query) => $query->orderBy('order', 'asc')
            ])
        ]);
    }
}
