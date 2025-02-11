<?php

namespace App\Actions;

use App\Models\Profile;
use Illuminate\Support\Facades\File;

class ProfilePictureDelete
{
    protected static $STORAGE_PATH = 'app/public/perfis/';

    public function execute(Profile $profile)
    {
        File::delete(storage_path(static::$STORAGE_PATH . $profile->photo));
        File::delete(storage_path(static::$STORAGE_PATH . $profile->thumbnail_photo));
    }
}
