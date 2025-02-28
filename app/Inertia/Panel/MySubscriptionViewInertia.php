<?php

namespace App\Inertia\Panel;

use Auth;
use Inertia\Inertia;
use Illuminate\Support\Collection;

class MySubscriptionViewInertia
{
    public function render(Collection $subscriptions)
    {
        /**
         * @var \App\Models\User
         */
        $user = Auth::user();

        return Inertia::render('panel/subscriptions/SubscriptionsView', [
            'subscriptions' => $subscriptions
        ]);
    }
}
