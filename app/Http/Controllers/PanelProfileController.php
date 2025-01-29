<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PanelProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('panel/profiles/ProfilesView', [
            'profiles' => Profile::withCount('media')->paginate()
        ]);
    }

    public function create()
    {
        return Inertia::render('panel/profiles/ProfilesCreateView');
    }

    public function store(ProfileRequest $request)
    {
        $filepath = $request->file('photo')->store('perfis', 'public');
        $filename = pathinfo($filepath, PATHINFO_BASENAME);

        $thumbnailFilepath = app(MediaService::class)->generateThumbnail(storage_path('app/public/' . $filepath));
        $thumbnailFilename = pathinfo($thumbnailFilepath, PATHINFO_BASENAME);

        Profile::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $filename,
            'thumbnail_photo' => $thumbnailFilename
        ]);

        return redirect()->route('panel.profiles.index');
    }

    public function edit(Profile $profile)
    {
        return Inertia::render('panel/profiles/ProfilesEditView', [
            'profile' => $profile
        ]);
    }

    public function update(Profile $profile, ProfileRequest $request)
    {
        if ($request->hasFile('photo')) {
            $filepath = $request->file('photo')->store('perfis', 'public');
            $filename = pathinfo($filepath, PATHINFO_BASENAME);

            $thumbnailFilepath = app(MediaService::class)->generateThumbnail(storage_path('app/public/' . $filepath));
            $thumbnailFilename = pathinfo($thumbnailFilepath, PATHINFO_BASENAME);
        }

        $profile->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'photo' => $filename ?? $profile->photo,
            'thumbnail_photo' => $thumbnailFilename ?? $profile->thumbnail_photo
        ]);

        return redirect()->route('panel.profiles.index');
    }
}
