<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Arr;

class UserCreateAction
{
    public function execute(array $data)
    {
        return User::create(Arr::only($data, ['name', 'email', 'password']));
    }
}
