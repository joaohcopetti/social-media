<?php

namespace App\Inertia\Main;

use App\Models\Profile;
use App\Models\Subscription;
use Auth;
use Illuminate\Support\Collection;
use Inertia\Inertia;

class ProfileViewInertia
{
    public function render(Profile $profile, Collection $media)
    {
        return Inertia::render('main/profile/ProfileView', [
            'profile' => $profile->loadMissing(['socialNetworks']),
            'media' => $media,
            'subscription' => Subscription::where('user_id', Auth::id())
                ->where('profile_id', $profile->id)
                ->first()
        ])->withViewData([
                    'title' => $profile->name,
                    'description' => $profile->description
                ]);
    }
}
