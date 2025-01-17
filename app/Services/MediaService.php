<?php

namespace App\Services;

class MediaService
{
    public function generateThumbnail($filepath)
    {
        $image = new \Imagick($filepath);
        $image->thumbnailImage(400, 400, true);

        $pathInfo = pathinfo($filepath);
        $thumbnailFilename = $pathInfo['filename'] . '_thumb.' . $pathInfo['extension'];
        $thumbnailFilepath = $pathInfo['dirname'] . '/' . $thumbnailFilename;

        $image->writeImage($thumbnailFilepath);

        return $thumbnailFilepath;
    }
}
