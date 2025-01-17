<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function socialNetworks()
    {
        return $this->hasMany(SocialNetwork::class);
    }
}
