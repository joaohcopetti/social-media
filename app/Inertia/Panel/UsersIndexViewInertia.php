<?php

namespace App\Inertia\Panel;

use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;

class UsersIndexViewInertia
{
    public function render(LengthAwarePaginator $users)
    {
        return Inertia::render('panel/users/UsersIndexView', [
            'users' => $users
        ]);
    }
}
