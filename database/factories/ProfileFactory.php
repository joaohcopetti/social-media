<?php

namespace Database\Factories;

use App\Enums\ImageMockDimensionEnum;
use App\Models\Profile;
use App\Services\MediaService;
use App\Support\Mock\MockAssetService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->firstNameFemale() . ' ' . fake()->lastName();
        $photo = app(MockAssetService::class)->copyRandomImageAndThumb(
            ImageMockDimensionEnum::_1000x1000,
            storage_path(Profile::$STORAGE_PATH)
        );

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'photo' => pathinfo($photo['image_path'], PATHINFO_BASENAME),
            'description' => fake()->optional(.5, null)->sentence()
        ];
    }
}
