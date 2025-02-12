<?php

namespace App\Actions;

use App\Models\Profile;

class ProfileMediaStoreAction
{
    public function execute(Profile $profile, array $data)
    {
        return $profile->media()->create([
            'filename' => pathinfo($data['filepath'], PATHINFO_BASENAME),
            'thumbnail_filename' => pathinfo($data['thumbnailFilepath'], PATHINFO_BASENAME),
            'size' => $data['file']->getSize(),
            'order' => $data['index'],
            'type' => $data['type']
        ]);
    }
}
