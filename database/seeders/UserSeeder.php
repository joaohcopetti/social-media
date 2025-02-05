<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected static $USERS = [
        [
            'email' => 'admin@email.com',
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
            User::factory()->create($user);
        }

        User::firstWhere('email', 'admin@email.com')->assignRole(RoleEnum::ADMIN);

        User::factory(100)->create();
    }
}
