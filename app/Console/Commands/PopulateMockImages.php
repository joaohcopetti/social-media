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

    protected static $DIMENSION_QUANTITY_MAP = [
        ImageMockDimensionEnum::_500x500->value => 10,
        ImageMockDimensionEnum::_900x600->value => 20
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $assetMockService = app(MockAssetService::class);
        $mediaService = app(MediaService::class);

        foreach (static::$DIMENSION_QUANTITY_MAP as $dimension => $quantity) {
            [$width, $height] = explode('x', $dimension);

            $this->info(
                "Storing $quantity images ($dimension) on " . MockAssetService::$STORAGE_PATH . '/' . $dimension
            );

            $bar = $this->output->createProgressBar($quantity);

            for ($i = 0; $i < $quantity; $i++) {
                $image = $assetMockService->fetchImage($width, $height);
                $filepath = $assetMockService->storeMockImage($dimension, $image->body());
                $mediaService->generateThumbnail($filepath);

                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
        }
    }
}
