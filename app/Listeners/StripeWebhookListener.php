<?php

namespace App\Listeners;

use Cache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Events\WebhookReceived;
use Laravel\Cashier\Subscription;

class StripeWebhookListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        $listeners = [
            'checkout.session.completed',
            'checkout.session.async_payment_succeeded'
        ];

        if (in_array($event->payload['type'], $listeners)) {
            defer(function () use ($event) {
                sleep(10);

                $user = Cashier::findBillable(data_get($event->payload, 'data.object.customer'));

                Cache::delete("subscriptions:{$user->id}");

                $subscriptionId = data_get($event->payload, 'data.object.subscription');
                $profileId = data_get($event->payload, 'data.object.metadata.profile_id');
                $subscription = Subscription::firstWhere('stripe_id', $subscriptionId);

                if ($subscription) {
                    $subscription->update(['profile_id' => $profileId]);
                }
            });
        }
    }
}
