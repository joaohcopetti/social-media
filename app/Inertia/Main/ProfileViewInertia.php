<?php

namespace App\Inertia\Main;

use App\Models\Profile;
use App\Models\Subscription;
use Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Stripe\Price;
use Stripe\Stripe;

class ProfileViewInertia
{
    public function render(Profile $profile, Collection $media)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        return Inertia::render('main/profile/ProfileView', [
            'profile' => $profile->loadMissing(['socialNetworks']),
            'media' => $media,
            'subscription' => Subscription::where('user_id', Auth::id())
                ->where('profile_id', $profile->id)
                ->first(),
            'price' => Cache::get($profile->stripe_price_id),
        ])->withViewData([
                    'title' => $profile->name,
                    'description' => $profile->description
                ]);
    }
}
