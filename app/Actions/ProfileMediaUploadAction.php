<?php

namespace App\Actions;

use Error;
use Illuminate\Http\UploadedFile;
use App\Services\MediaService;
use Illuminate\Support\Arr;

class ProfileMediaUploadAction
{
    public function execute(UploadedFile $file, UploadedFile $thumbnailFile = null)
    {
        $type = Arr::first(explode('/', $file->getMimeType()));
        $filepath = $file->store('midias');

        $thumbnailFilepath = $this->storeOrGenerateThumbnail($thumbnailFile, $filepath, $type);

        return [
            'type' => $type,
            'filepath' => $filepath,
            'thumbnailFilepath' => $thumbnailFilepath
        ];
    }

    private function storeOrGenerateThumbnail(
        UploadedFile $thumbnailFile = null,
        string $mediaFilepath,
        string $type
    ) {
        if ($type === 'image') {
            return app(MediaService::class)->generateThumbnail(
                storage_path("app/private/$mediaFilepath")
            );
        }

        if ($type === 'video' && !$thumbnailFile) {
            throw new Error('Video thumbnail not found');
        }

        if ($type === 'video') {
            $thumbnailFilename = app(MediaService::class)->generateThumbnailFilename($mediaFilepath);

            return $thumbnailFile->storeAs('midias', $thumbnailFilename);
        }

        throw new Error('Media type not supported');
    }
}
