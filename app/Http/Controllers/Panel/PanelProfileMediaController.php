<?php

namespace App\Http\Controllers\Panel;

use App\Actions\ProfileMediaDeleteAction;
use App\Actions\ProfileMediaStoreAction;
use App\Actions\ProfileMediaUploadAction;
use App\Http\Requests\PanelProfileMediaRequest;
use App\Inertia\Panel\ProfileMediaViewInertia;
use App\Models\Profile;
use App\Models\ProfileMedia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PanelProfileMediaController extends Controller
{
    public function edit(Profile $profile)
    {
        return app(ProfileMediaViewInertia::class)->render($profile);
    }

    public function store(Profile $profile, PanelProfileMediaRequest $request)
    {
        $storedMediaData = app(ProfileMediaUploadAction::class)->execute($request->file('file'));

        $media = app(ProfileMediaStoreAction::class)->execute(
            $profile,
            array_merge($request->all(), $storedMediaData)
        );

        return response()->json([
            'message' => 'Media uploaded',
            'media' => $media
        ]);
    }

    public function destroy(ProfileMedia $profileMedia)
    {
        app(ProfileMediaDeleteAction::class)->execute($profileMedia);

        return response()->json([
            'message' => 'Media deleted'
        ]);
    }

    public function toggleState(ProfileMedia $profileMedia, Request $request)
    {
        $request->validate([
            'state' => [Rule::in(['free', 'show-on-home'])]
        ]);

        if ($request->input('state') === 'free') {
            $profileMedia->update([
                'is_free' => !$profileMedia->is_free,
                'show_on_home' => false
            ]);
        }

        if ($request->input('state') === 'show-on-home') {
            $profileMedia->update([
                'show_on_home' => !$profileMedia->show_on_home
            ]);
        }

        return response()->json([
            'message' => 'Estado alterado!',
            'profileMedia' => $profileMedia
        ]);
    }
}
