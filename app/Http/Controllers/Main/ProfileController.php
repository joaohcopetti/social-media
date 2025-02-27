<?php

namespace App\Http\Controllers\Main;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Inertia\Main\ProfileViewInertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;

class ProfileController extends Controller
{
    public function index(Profile $profile)
    {
        return app(ProfileViewInertia::class)->render(
            $profile,
            $profile->media()
                ->where('show_on_home', true)
                ->where('is_free', true)
                ->orderBy('order', 'desc')
                ->get()
        );
    }

    public function free(Profile $profile)
    {
        return app(ProfileViewInertia::class)->render(
            $profile,
            $profile->media()
                ->where('is_free', true)
                ->orderBy('order', 'desc')
                ->get()
        );
    }

    public function premium(Profile $profile)
    {
        return app(ProfileViewInertia::class)->render(
            $profile,
            $profile->media()
                ->where('is_free', false)
                ->orderBy('order', 'desc')
                ->get()
        );
    }

    public function subscribe(Profile $profile, Request $request)
    {
        /**
         * @var \App\Models\User
         */
        $user = Auth::user();

        return $user->newSubscription('default', $profile->stripe_price_id)->checkout([
            'success_url' => route('profile.index', ['profile' => $profile->slug]),
            'cancel_url' => route('profile.index', ['profile' => $profile->slug])
        ]);
    }
}
