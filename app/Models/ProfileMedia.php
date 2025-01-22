<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileMedia extends Model
{
    use HasFactory;

    public static $STORAGE_PATH = 'app/public/profiles/';

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
