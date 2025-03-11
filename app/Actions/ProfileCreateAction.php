<?php

namespace App\Actions;

use App\Models\Profile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use App\Services\MediaService;
use Illuminate\Support\Facades\Cache;
use Stripe\Price;
use Stripe\Stripe;

class ProfileCreateAction
{
    public function execute(array $data): Profile
    {
        $paths = app(ProfilePictureStore::class)->execute($data['photo']);

        if (!empty($data['stripe_price_id'])) {
            Stripe::setApiKey(config('services.stripe.secret'));
            $price = Price::retrieve($data['stripe_price_id']);

            Cache::rememberForever($data['stripe_price_id'], fn() => $price->unit_amount / 100);
        }

        return Profile::create(array_merge(
            Arr::only($data, ['name', 'description', 'stripe_price_id']),
            [
                'photo' => $paths['filepath'],
                'thumbnail_photo' => $paths['thumbnail_filepath']
            ]
        ));
    }
}
