<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Auth\Authenticatable;

class UserUpdateAction
{
    public function execute(User|Authenticatable $user, array $data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);
    }
}
