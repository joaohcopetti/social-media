<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PanelProfileRequest;
use App\Inertia\Panel\ProfilesEditViewInertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Actions\ProfileUpdateAction;
use App\Actions\ProfileSyncNetworksAction;

class PanelMyProfileController extends Controller
{
    public function edit()
    {
        return app(ProfilesEditViewInertia::class)->render(Auth::user()->profile);
    }

    public function update(PanelProfileRequest $request)
    {
        DB::beginTransaction();

        $profile = Auth::user()->profile;

        app(ProfileUpdateAction::class)->execute($profile, $request->validated());
        app(ProfileSyncNetworksAction::class)->execute($profile, $request->validated());

        DB::commit();

        return redirect()->route('panel.my-profile.edit');
    }
}
