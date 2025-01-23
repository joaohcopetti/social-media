<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ProfileMedia;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(Profile $profile)
    {
        return Inertia::render('profile/ProfileView', [
            'profile' => $profile->load('socialNetworks'),
            'media' => $profile->media()
                ->where('show_on_home', true)
                ->where('is_free', true)
                ->get()
        ]);
    }

    public function free(Profile $profile)
    {
        return Inertia::render('profile/ProfileView', [
            'profile' => $profile->load('socialNetworks'),
            'media' => $profile->media()
                ->where('is_free', true)
                ->get()
        ]);
    }

    public function premium()
    {
        return Inertia::render('profile/ProfileView');
    }
}
