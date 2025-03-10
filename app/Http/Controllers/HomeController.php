<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();

        if ($profile) {
            return redirect()->route('profile.index', ['profile' => $profile->slug]);
        }

        return Inertia::render('HomeView');
    }
}
