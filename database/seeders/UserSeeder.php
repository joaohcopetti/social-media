<?php

namespace Database\Seeders;

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
            User::factory($user);
        }
    }
}
