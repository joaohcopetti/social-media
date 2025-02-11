<?php

namespace App\Actions;

use App\Services\MediaService;
use Illuminate\Http\UploadedFile;

class ProfilePictureStore
{
    public function execute(UploadedFile $photo)
    {
        $filepath = $photo->store('perfis', 'public');
        $thumbnailFilepath = app(MediaService::class)->generateThumbnail(
            storage_path("app/public/$filepath")
        );

        return [
            'filepath' => pathinfo($filepath, PATHINFO_BASENAME),
            'thumbnail_filepath' => pathinfo($thumbnailFilepath, PATHINFO_BASENAME)
        ];
    }
}
