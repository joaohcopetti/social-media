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
            storage_path('app/public/perfis/')
        );

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'photo' => pathinfo($photo['image_path'], PATHINFO_BASENAME),
            'thumbnail_photo' => pathinfo($photo['thumb_path'], PATHINFO_BASENAME),
            'description' => fake()->optional(.5, null)->sentence(),
            'subscription_price' => fake()->randomElement([
                1000,
                2000,
                5000,
                10000,
                20000,
            ])
        ];
    }
}
