<?php

namespace App\Http\Controllers;

use App\Http\Requests\PanelProfileRequest;
use App\Models\Profile;
use App\Models\SocialNetwork;
use App\Services\MediaService;
use DB;
use File;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PanelProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('panel/profiles/ProfilesView', [
            'profiles' => Profile::withCount('media')
                ->orderBy('created_at', 'desc')
                ->paginate()
        ]);
    }

    public function create()
    {
        return Inertia::render('panel/profiles/ProfilesCreateView');
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

        $profile = Profile::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $filename,
            'thumbnail_photo' => $thumbnailFilename
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
        return Inertia::render('panel/profiles/ProfilesEditView', [
            'profile' => $profile->load('socialNetworks')
        ]);
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
