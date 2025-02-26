<?php

namespace App\Inertia\Panel;

use Inertia\Inertia;

class MySubscriptionViewInertia
{
    public function render()
    {
        return Inertia::render('panel/subscriptions/SubscriptionsView');
    }
}
