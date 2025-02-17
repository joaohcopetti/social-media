<?php

namespace App\Http\Controllers\Main;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Inertia\Main\ProfileViewInertia;

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
}
