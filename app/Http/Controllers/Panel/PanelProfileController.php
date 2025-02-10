<?php

namespace App\Http\Controllers\Panel;

use App\Enums\RolesEnum;
use App\Http\Requests\PanelProfileRequest;
use App\Inertia\Panel\ProfilesCreateViewInertia;
use App\Inertia\Panel\ProfilesEditViewInertia;
use App\Inertia\Panel\ProfilesIndexViewInertia;
use App\Models\Profile;
use App\Models\SocialNetwork;
use App\Models\User;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

        $filepath = $request->file('photo')->store('perfis', 'public');
        $filename = pathinfo($filepath, PATHINFO_BASENAME);

        $thumbnailFilepath = app(MediaService::class)->generateThumbnail(
            storage_path('app/public/' . $filepath)
        );

        $thumbnailFilename = pathinfo($thumbnailFilepath, PATHINFO_BASENAME);

        if ($request->boolean('is_user')) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $user->assignRole(RolesEnum::INFLUENCER->value);
        }

        $profile = Profile::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $filename,
            'thumbnail_photo' => $thumbnailFilename,
            'user_id' => $user?->id
        ]);

        $this->syncSocialNetworks($request, $profile);

        DB::commit();

        return redirect()->route('panel.profiles.manage-media', ['profile' => $profile->slug]);
    }

    public function syncSocialNetworks(Request $request, Profile $profile)
    {
        $socialNetworks = SocialNetwork::all();
        $requestNetworks = $request->only($socialNetworks->pluck('name')->toArray());

        foreach ($socialNetworks as $socialNetwork) {
            if (!isset($requestNetworks[$socialNetwork->name])) {
                $profile->socialNetworks()->detach($socialNetwork->id);
                continue;
            }

            $profile->socialNetworks()->detach($socialNetwork->id);
            $profile->socialNetworks()->attach($socialNetwork->id, [
                'url' => $requestNetworks[$socialNetwork->name]
            ]);
        }
    }

    public function edit(Profile $profile)
    {
        return app(ProfilesEditViewInertia::class)->render($profile);
    }

    public function update(Profile $profile, PanelProfileRequest $request)
    {
        if ($request->hasFile('photo')) {
            File::delete(storage_path('app/public/perfis/' . $profile->photo));
            File::delete(storage_path('app/public/perfis/' . $profile->thumbnail_photo));

            $filepath = $request->file('photo')->store('perfis', 'public');
            $filename = pathinfo($filepath, PATHINFO_BASENAME);

            $thumbnailFilepath = app(MediaService::class)
                ->generateThumbnail(storage_path('app/public/' . $filepath));

            $thumbnailFilename = pathinfo($thumbnailFilepath, PATHINFO_BASENAME);
        }

        $profile->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'photo' => $filename ?? $profile->photo,
            'thumbnail_photo' => $thumbnailFilename ?? $profile->thumbnail_photo
        ]);

        $this->syncSocialNetworks($request, $profile);

        return redirect()->route('panel.profiles.index');
    }
}
