<?php


namespace App\Actions;

use App\Models\Profile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Stripe\Stripe;
use Stripe\Price;

class ProfileUpdateAction
{
    public function execute(Profile $profile, array $data)
    {
        $paths = null;

        if (!empty($data['stripe_price_id'])) {
            Stripe::setApiKey(config('services.stripe.secret'));
            $price = Price::retrieve($data['stripe_price_id']);

            Cache::rememberForever($data['stripe_price_id'], fn() => $price->unit_amount / 100);
        }

        if (isset($data['photo']) && $data['photo']) {
            app(ProfilePictureDelete::class)->execute($profile);

            $paths = app(ProfilePictureStore::class)->execute($data['photo']);
        }

        $data = array_merge(
            Arr::only($data, ['name', 'description', 'stripe_price_id']),
            $paths
            ? ['photo' => $paths['filepath'], 'thumbnail_photo' => $paths['thumbnail_filepath']]
            : [],
        );

        $profile->update($data);
    }
}
