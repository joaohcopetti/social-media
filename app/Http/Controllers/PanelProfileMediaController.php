<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Arr;
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
        $mime = Arr::first(explode('/', $request->file('file')->getMimeType()));

        if ($mime === 'image') {
            $filename = $request->file('file')->store('private/midias');
        }

        $profile->media()->create([

        ]);
        dd($mime);
        dd($request->all());
        dd($profile);
    }
}
