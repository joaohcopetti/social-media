<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PanelProfileMediaController extends Controller
{
    public function edit(Profile $profile)
    {
        return Inertia::render('panel/media/ProfileMediaManagementView', [
            'profile' => $profile
        ]);
    }

    public function store(Profile $profile, Request $request)
    {
        dd($request->all());
    }
}
