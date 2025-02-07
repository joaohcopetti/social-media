<?php

namespace App\Support\Mock;

use App\Enums\ImageMockDimensionEnum;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MockAssetService
{
    public static $STORAGE_PATH = 'app/mock';

    public function fetchImage(int $width, int $height)
    {
        $provider = 'https://picsum.photos';
        $url = "$provider/$width/$height";

        $response = Http::get($url);

        return $response;
    }

    public function storeMockImage(string $body)
    {
        $filename = Str::random() . '.jpg';

        $path = storage_path(static::$STORAGE_PATH);
        $filepath = "$path/$filename";

        if (!is_dir($path)) {
            mkdir($path);
        }

        File::put($filepath, $body);

        return $filepath;
    }

    public function copyRandomImageAndThumb(string $toDir)
    {
        $this->makeDirIfNotExists($toDir);

        [$imagePath, $thumbPath] = $this->retrieveRandomImageAndThumb();

        $randomFilename = Str::random();
        $destImage = $toDir
            . $randomFilename
            . '.'
            . pathinfo($imagePath, PATHINFO_EXTENSION);

        $destImageThumb = $toDir
            . "{$randomFilename}_thumb"
            . '.'
            . pathinfo($thumbPath, PATHINFO_EXTENSION);

        File::copy($imagePath, $destImage);
        File::copy($thumbPath, $destImageThumb);

        return [
            'image_path' => $destImage,
            'thumb_path' => $destImageThumb
        ];
    }

    private function makeDirIfNotExists($dir)
    {
        if (is_dir($dir)) {
            return;
        }

        mkdir($dir, 0777, true);
    }

    private function retrieveRandomImageAndThumb()
    {
        $mockImagesGlobPattern = storage_path(static::$STORAGE_PATH . '/*');

        $allImages = collect(glob($mockImagesGlobPattern));

        $imagesWithoutThumb = $allImages->where(
            fn(string $path) => !Str::contains($path, '_thumb')
        );

        $randomImage = $imagesWithoutThumb->random();
        $filename = pathinfo($randomImage, PATHINFO_FILENAME);

        return $allImages
            ->where(fn(string $path) => Str::contains($path, $filename))
            ->values();
    }
}
