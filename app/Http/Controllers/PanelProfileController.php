<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
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
        $filepath = $request->file('photo')->store('profiles', 'public');
        $filename = pathinfo($filepath, PATHINFO_BASENAME);

        Profile::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $filename
        ]);

        return redirect()->route('panel.profiles.index');
    }
}
