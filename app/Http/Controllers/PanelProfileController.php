<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PanelProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('panel/profiles/ProfilesView');
    }
}
