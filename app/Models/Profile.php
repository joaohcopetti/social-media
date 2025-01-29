<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Profile extends Model
{
    use HasFactory, HasSlug;

    public static $STORAGE_PATH = 'app/public/profiles/';
    public static $PUBLIC_PATH = 'storage/profiles/';

    protected $fillable = [
        'name',
        'description',
        'photo'
    ];

    protected $appends = [
        'photo_url'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function photoUrl(): Attribute
    {
        return Attribute::make(
            get: fn(): string => '/' . static::$PUBLIC_PATH . $this->photo
        );
    }

    public function media()
    {
        return $this->hasMany(ProfileMedia::class);
    }

    public function socialNetworks()
    {
        return $this->belongsToMany(SocialNetwork::class)->orderBy('order');
    }
}
