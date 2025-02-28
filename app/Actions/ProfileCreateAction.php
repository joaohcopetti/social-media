<?php

namespace App\Actions;

use App\Models\Profile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use App\Services\MediaService;

class ProfileCreateAction
{
    public function execute(array $data): Profile
    {
        $paths = app(ProfilePictureStore::class)->execute($data['photo']);

        return Profile::create(array_merge(
            Arr::only($data, ['name', 'description', 'stripe_price_id']),
            [
                'photo' => $paths['filepath'],
                'thumbnail_photo' => $paths['thumbnail_filepath']
            ]
        ));
    }
}
