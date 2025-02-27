<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Profile extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'description',
        'photo',
        'thumbnail_photo',
        'user_id',
        'stripe_price_id'
    ];

    protected $appends = [
        'photo_url',
        'photo_thumb_url'
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
            get: fn(): string => "/storage/perfis/{$this->photo}"
        );
    }

    public function photoThumbUrl(): Attribute
    {
        return Attribute::make(
            get: fn(): string => "/storage/perfis/{$this->thumbnail_photo}"
        );
    }

    public function media(): HasMany
    {
        return $this->hasMany(ProfileMedia::class);
    }

    public function socialNetworks(): BelongsToMany
    {
        return $this->belongsToMany(SocialNetwork::class)
            ->orderBy('order')
            ->withPivot(['url']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
