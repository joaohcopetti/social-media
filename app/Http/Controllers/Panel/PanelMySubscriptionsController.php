<?php

namespace App\Http\Controllers\Panel;

use App\Inertia\Panel\MySubscriptionViewInertia;
use App\Models\Profile;
use App\Models\Subscription;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PanelMySubscriptionsController
{
    public function index()
    {
        $user = Auth::user();
        $subscriptions = $user
            ->subscriptions()
            ->whereHas('profile')
            ->with('profile')
            ->get()
            ->map(
                function (Subscription $subscription) {
                    $subscription->asStripe = $subscription->asStripeSubscription();

                    return $subscription;
                }
            );

        return app(MySubscriptionViewInertia::class)->render($subscriptions);
    }

    public function cancel(Profile $profile)
    {
        $user = Auth::user();

        Subscription::query()->active()->firstWhere([
            'profile_id' => $profile->id,
            'user_id' => $user->id
        ])->cancel();

        return redirect()->route('panel.my-subscriptions.index');
    }
}
