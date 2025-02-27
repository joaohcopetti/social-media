<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
        if ($event->payload['type'] === 'checkout.session.completed') {
            defer(function () use ($event) {
                sleep(10);
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
