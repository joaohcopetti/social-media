<?php

namespace App\Http\Controllers;

use App\Models\Profile;
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

    public function premium(Profile $profile)
    {
        return Inertia::render('profile/ProfileView', [
            'profile' => $profile->load('socialNetworks'),
            'media' => $profile->media()
                ->where('is_free', false)
                ->get()
        ]);
    }
}
