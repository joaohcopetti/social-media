<?php

namespace App\Http\Controllers\Panel;

use App\Actions\ProfileCreateAction;
use App\Actions\ProfileSyncNetworksAction;
use App\Actions\ProfileUpdateAction;
use App\Actions\UserCreateAction;
use App\Enums\RolesEnum;
use App\Http\Requests\PanelProfileRequest;
use App\Inertia\Panel\ProfilesCreateViewInertia;
use App\Inertia\Panel\ProfilesEditViewInertia;
use App\Inertia\Panel\ProfilesIndexViewInertia;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PanelProfileController extends Controller
{
    public function index()
    {
        return app(ProfilesIndexViewInertia::class)->render(
            Profile::withCount('media')
                ->orderBy('created_at', 'desc')
                ->paginate()
        );
    }

    public function create()
    {
        return app(ProfilesCreateViewInertia::class)->render();
    }

    public function store(PanelProfileRequest $request)
    {
        DB::beginTransaction();

        $profile = app(ProfileCreateAction::class)->execute($request->all());

        app(ProfileSyncNetworksAction::class)->execute($profile, $request->all());

        if ($request->boolean('is_user')) {
            $user = app(UserCreateAction::class)->execute($request->all());

            $user->assignRole(RolesEnum::INFLUENCER->value);
        }

        DB::commit();

        return redirect()->route('panel.profiles.manage-media', ['profile' => $profile->slug]);
    }

    public function edit(Profile $profile)
    {
        return app(ProfilesEditViewInertia::class)->render($profile);
    }

    public function update(Profile $profile, PanelProfileRequest $request)
    {
        DB::beginTransaction();

        app(ProfileUpdateAction::class)->execute($profile, $request->all());
        app(ProfileSyncNetworksAction::class)->execute($profile, $request->all());

        DB::commit();

        return redirect()->route('panel.profiles.index');
    }
}
