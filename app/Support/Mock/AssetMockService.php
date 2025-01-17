<?php

namespace App\Support\Mock;

use App\Enums\ImageMockDimensionEnum;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AssetMockService
{
    public static $STORAGE_PATH = 'app/mock';

    public function fetchImage($width, $height)
    {
        $provider = 'https://picsum.photos';
        $url = "$provider/$width/$height";

        $response = Http::get($url);

        return $response;
    }

    public function storeMockImage($folder, $body)
    {
        $filename = Str::random() . '.jpg';

        $path = storage_path(static::$STORAGE_PATH . '/' . $folder);
        $filepath = "$path/$filename";

        if (!is_dir($path)) {
            mkdir($path);
        }

        File::put($filepath, $body);

        return $filepath;
    }

    public function copyRandomImageAndThumb(ImageMockDimensionEnum $dimension, $toFolder)
    {
        [$imagePath, $thumbPath] = $this->retrieveRandomImageAndThumb($dimension);

        $randomFilename = Str::random();
        $destImage = $toFolder
            . $randomFilename
            . '.'
            . pathinfo($imagePath, PATHINFO_EXTENSION);

        $destImageThumb = $toFolder
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

    private function retrieveRandomImageAndThumb(ImageMockDimensionEnum $dimension)
    {
        $mockImagesGlobPattern = storage_path(static::$STORAGE_PATH . '/' . $dimension->value . '/*');

        $allImages = collect(glob($mockImagesGlobPattern));
        $imagesWithoutThumb = $allImages->where(fn(string $path) => !Str::contains($path, '_thumb'));

        $randomImage = $imagesWithoutThumb->random();
        $filename = pathinfo($randomImage, PATHINFO_FILENAME);

        return $allImages
            ->where(fn(string $path) => Str::contains($path, $filename))
            ->values();
    }
}
