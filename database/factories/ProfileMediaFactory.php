<?php

namespace Database\Factories;

use App\Enums\ImageMockDimensionEnum;
use App\Models\ProfileMedia;
use App\Support\Mock\MockAssetService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileMedia>
 */
class ProfileMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isFree = fake()->boolean(30);
        $path = app(MockAssetService::class)->copyRandomImageAndThumb(
            ImageMockDimensionEnum::_1980x1080,
            storage_path(ProfileMedia::$STORAGE_PATH)
        );

        return [
            'description' => fake()->optional(.2)->sentence(),
            'is_free' => $isFree,
            'show_on_home' => $isFree,
            'filename' => pathinfo($path['image_path'], PATHINFO_BASENAME),
            'thumbnail_filename' => pathinfo($path['thumb_path'], PATHINFO_BASENAME),
            'size' => fake()->numberBetween(2 ** 10, 2 ** 20)
        ];
    }
}
