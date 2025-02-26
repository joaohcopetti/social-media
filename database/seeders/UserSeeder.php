<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class UserSeeder extends Seeder
{
    protected static $STATIC_USERS = [
        [
            'email' => 'admin@email.com',
            'password' => 'secret',
            'role' => RolesEnum::ADMIN->value
        ],
        [
            'email' => 'influencer@email.com',
            'password' => 'secret',
            'role' => RolesEnum::INFLUENCER->value
        ],
        [
            'email' => 'customer@email.com',
            'password' => 'secret',
            'role' => RolesEnum::CUSTOMER->value
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::$STATIC_USERS as $staticUser) {
            $credentials = Arr::only($staticUser, ['email', 'password']);

            $user = User::factory()->create($credentials);
            $user->assignRole($staticUser['role']);

            if ($staticUser['email'] === 'influencer@email.com') {
                $this->seedUserProfile($user);
            }
        }
    }

    private function seedUserProfile($user)
    {
        $profile = Profile::factory()->create([
            'name' => $user->name,
            'slug' => Str::slug($user->name),
            'user_id' => $user->id
        ]);

        app(ProfileSeeder::class)->seedProfileMedia([$profile]);
        app(ProfileSeeder::class)->seedProfileSocialNetworks([$profile]);
    }
}
