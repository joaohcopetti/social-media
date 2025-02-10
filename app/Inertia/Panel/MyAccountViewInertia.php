<?php

namespace App\Inertia\Panel;

use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Inertia\Inertia;

class MyAccountViewInertia
{
    public function render(User|Authenticatable $user)
    {
        return Inertia::render('users/MyAccountView', [
            'user' => $user
        ]);
    }
}
