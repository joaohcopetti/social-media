<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PanelProfileMediaRequest;
use App\Models\ProfileMedia;
use App\Inertia\Panel\ProfileMediaViewInertia;
use Illuminate\Support\Facades\Auth;
use App\Actions\ProfileMediaUploadAction;
use App\Actions\ProfileMediaStoreAction;
use Illuminate\Validation\Rule;
use App\Actions\ProfileMediaDeleteAction;

class PanelMyMediaController extends Controller
{
    public function manage()
    {
        return app(ProfileMediaViewInertia::class)->render(Auth::user()->profile);
    }

    public function upload(PanelProfileMediaRequest $request)
    {
        $profile = Auth::user()->profile;

        $storedMediaData = app(ProfileMediaUploadAction::class)
            ->execute($request->file('file'));

        $media = app(ProfileMediaStoreAction::class)->execute(
            $profile,
            array_merge($request->all(), $storedMediaData)
        );

        return response()->json([
            'message' => 'Media uploaded',
            'media' => $media
        ]);
    }

    public function toggleState(ProfileMedia $profileMedia, Request $request)
    {
        if ($profileMedia->profile->id !== Auth::user()->profile->id) {
            abort(403);
        }

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

    public function delete(ProfileMedia $profileMedia)
    {
        if ($profileMedia->profile->id !== Auth::user()->profile->id) {
            abort(403);
        }

        app(ProfileMediaDeleteAction::class)->execute($profileMedia);

        return response()->json([
            'message' => 'Media deleted'
        ]);
    }
}
