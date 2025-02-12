<?php

namespace App\Services;

class MediaService
{
    public function generateThumbnail(string $filepath, int $relativeDimension = 400)
    {
        $image = new \Imagick($filepath);
        $image->autoOrient();
        $image->thumbnailImage($relativeDimension, $relativeDimension, true);

        $thumbnailFilename = $this->generateThumbnailFilename($filepath);
        $thumbnailFilepath = pathinfo($filepath, PATHINFO_DIRNAME) . '/' . $thumbnailFilename;

        $image->writeImage($thumbnailFilepath);

        return $thumbnailFilepath;
    }

    public function generateThumbnailFilename(string $filepath)
    {
        $pathInfo = pathinfo($filepath);

        return $pathInfo['filename'] . '_thumb.' . $pathInfo['extension'];
    }
}
