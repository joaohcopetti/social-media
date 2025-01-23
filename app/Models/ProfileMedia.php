<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileMedia extends Model
{
    use HasFactory;

    public static $STORAGE_PATH = 'app/private/profiles/';

    protected $appends = [
        'url'
    ];

    public function url(): Attribute
    {
        return Attribute::make(
            fn() => route('profile.media', [
                'filename' => $this->path
            ])
        );
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
