<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('profile/ProfileView');
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
