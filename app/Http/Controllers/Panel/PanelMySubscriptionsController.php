<?php

namespace App\Http\Controllers\Panel;

use App\Inertia\Panel\MySubscriptionViewInertia;

class PanelMySubscriptionsController
{
    public function index()
    {
        return app(MySubscriptionViewInertia::class)->render();
    }
}
