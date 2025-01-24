<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ProfileFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
