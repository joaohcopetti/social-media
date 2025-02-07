<?php

namespace App\Console\Commands;

use App\Enums\ImageMockDimensionEnum;
use App\Services\MediaService;
use App\Support\Mock\MockAssetService;
use Illuminate\Console\Command;

class PopulateMockImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-mock-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $assetMockService = app(MockAssetService::class);
        $mediaService = app(MediaService::class);
        $quantity = 10;

        $this->info("Storing images on " . MockAssetService::$STORAGE_PATH . '/');
        $bar = $this->output->createProgressBar($quantity);

        for ($i = 0; $i < $quantity; $i++) {
            $width = fake()->numberBetween(1000, 3000);
            $height = fake()->numberBetween(1000, 3000);

            $image = $assetMockService->fetchImage($width, $height);
            $filepath = $assetMockService->storeMockImage($image->body());
            $mediaService->generateThumbnail($filepath);

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
    }
}
