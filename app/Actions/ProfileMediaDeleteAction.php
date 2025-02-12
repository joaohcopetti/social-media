<?php

namespace App\Actions;

use App\Models\ProfileMedia;
use Illuminate\Support\Facades\File;

class ProfileMediaDeleteAction
{
    protected static $STORAGE_PATH = 'app/private/midias/';

    public function execute(ProfileMedia $profileMedia)
    {
        File::delete(storage_path(static::$STORAGE_PATH . $profileMedia->filename));
        File::delete(storage_path(static::$STORAGE_PATH . $profileMedia->thumbnail_filename));

        $profileMedia->delete();
    }
}
