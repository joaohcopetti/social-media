<?php

namespace App\Inertia\Panel;

use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;

class ProfilesIndexViewInertia
{
    public function render(LengthAwarePaginator $profiles)
    {
        return Inertia::render('panel/profiles/ProfilesIndexView', [
            'profiles' => $profiles
        ]);
    }
}
