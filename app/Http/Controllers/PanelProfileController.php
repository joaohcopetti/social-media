<?php

namespace App\Http\Controllers;

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
}
