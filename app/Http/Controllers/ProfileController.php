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
            'profile' => $profile->load('socialNetworks')
        ]);
    }

    public function media(string $filename)
    {
        $path = storage_path(ProfileMedia::$STORAGE_PATH . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function free()
    {
        return Inertia::render('profile/ProfileView');
    }

    public function premium()
    {
        return Inertia::render('profile/ProfileView');
    }
}
