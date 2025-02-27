<?php


namespace App\Actions;

use App\Models\Profile;
use Illuminate\Support\Arr;

class ProfileUpdateAction
{
    public function execute(Profile $profile, array $data)
    {
        $paths = null;

        if (isset($data['photo']) && $data['photo']) {
            app(ProfilePictureDelete::class)->execute($profile);

            $paths = app(ProfilePictureStore::class)->execute($data['photo']);
        }

        $data = array_merge(
            Arr::only($data, ['name', 'description', 'stripe_price_id']),
            $paths
            ? ['photo' => $paths['filepath'], 'thumbnail_photo' => $paths['thumbnail_filepath']]
            : []
        );

        $profile->update($data);
    }
}
