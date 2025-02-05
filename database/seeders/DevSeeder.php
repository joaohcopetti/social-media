<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        File::deleteDirectory(storage_path('app/private/profiles'));
        File::deleteDirectory(storage_path('app/public/profiles'));

        $this->call([
            PermissionSeeder::class,
            SocialNetworkSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
        ]);
    }
}
