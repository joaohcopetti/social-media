<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public static $STORAGE_PATH = 'app/public/profiles/';
    public static $PUBLIC_PATH = 'storage/profiles/';

    protected $appends = [
        'photo_url'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function photoUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => static::$PUBLIC_PATH . $this->photo
        );
    }

    public function media()
    {
        return $this->hasMany(ProfileMedia::class);
    }

    public function socialNetworks()
    {
        return $this->hasMany(SocialNetwork::class);
    }
}
