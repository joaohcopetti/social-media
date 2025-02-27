<?php

namespace App\Inertia\Panel;

use Auth;
use Inertia\Inertia;

class MySubscriptionViewInertia
{
    public function render()
    {
        /**
         * @var \App\Models\User
         */
        $user = Auth::user();

        return Inertia::render('panel/subscriptions/SubscriptionsView');
    }
}
