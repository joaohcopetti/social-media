<?php

namespace App\Services;

use Illuminate\Support\Str;

class MediaService
{
    public function generateThumbnail(string $filepath, int $relativeDimension = 400)
    {
        $image = new \Imagick($filepath);
        $image->autoOrient();
        $image->thumbnailImage($relativeDimension, $relativeDimension, true);

        $pathInfo = pathinfo($filepath);
        $thumbnailFilename = $pathInfo['filename'] . '_thumb.' . $pathInfo['extension'];
        $thumbnailFilepath = $pathInfo['dirname'] . '/' . $thumbnailFilename;

        $image->writeImage($thumbnailFilepath);

        return $thumbnailFilepath;
    }
}
