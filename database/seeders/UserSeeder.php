<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    protected static $USERS = [
        [
            'email' => 'admin@email.com',
            'password' => 'secret'
        ],
        [
            'email' => 'influencer@email.com',
            'password' => 'secret'
        ],
        [
            'email' => 'customer@email.com',
            'password' => 'secret'
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::$USERS as $user) {
            $createdUser = User::factory()->create($user);

            if ($user['email'] === 'influencer@email.com') {
                $profile = Profile::factory()->create([
                    'name' => $createdUser->name,
                    'slug' => Str::slug($createdUser->name),
                    'user_id' => $createdUser->id
                ]);

                app(ProfileSeeder::class)->seedProfileMedia([$profile]);
                app(ProfileSeeder::class)->seedProfileSocialNetworks([$profile]);
            }
        }

        User::firstWhere('email', 'admin@email.com')->assignRole(RoleEnum::ADMIN);

        User::factory(100)->create();
    }
}
