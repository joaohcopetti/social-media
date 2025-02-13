<?php

namespace App\Http\Controllers\Panel;

use App\Actions\UserUpdateAction;
use App\Inertia\Panel\MyAccountViewInertia;
use App\Inertia\Panel\ProfileMediaViewInertia;
use App\Inertia\Panel\ProfilesEditViewInertia;
use App\Models\ProfileMedia;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MyAccountRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\PanelProfileRequest;
use Illuminate\Support\Facades\DB;
use App\Actions\ProfileUpdateAction;
use App\Actions\ProfileSyncNetworksAction;
use App\Http\Requests\PanelProfileMediaRequest;
use App\Actions\ProfileMediaUploadAction;
use App\Actions\ProfileMediaStoreAction;
use App\Actions\ProfileMediaDeleteAction;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PanelMyAccountController extends Controller
{
    public function myAccount()
    {
        return app(MyAccountViewInertia::class)->render(Auth::user());
    }

    public function myAccountUpdate(MyAccountRequest $request)
    {
        app(UserUpdateAction::class)->execute(
            Auth::user(),
            $request->validated()
        );

        return redirect()->route('panel.user.my-account');
    }

    public function myProfile()
    {
        return app(ProfilesEditViewInertia::class)->render(Auth::user()->profile);
    }

    public function myProfileUpdate(PanelProfileRequest $request)
    {
        DB::beginTransaction();

        $profile = Auth::user()->profile;

        app(ProfileUpdateAction::class)->execute($profile, $request->validated());
        app(ProfileSyncNetworksAction::class)->execute($profile, $request->validated());

        DB::commit();

        return redirect()->route('panel.user.my-profile');
    }

    public function myMedia()
    {
        return app(ProfileMediaViewInertia::class)->render(Auth::user()->profile);
    }

    public function myMediaUpdate(PanelProfileMediaRequest $request)
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

    public function myMediaToggleState(ProfileMedia $profileMedia, Request $request)
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

    public function myMediaDelete(ProfileMedia $profileMedia)
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
