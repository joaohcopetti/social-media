<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileMedia;

class ProfileMediaController extends Controller
{
    public function media(ProfileMedia $profileMedia)
    {
        $path = storage_path(ProfileMedia::$STORAGE_PATH . $profileMedia->path);

        if (!$profileMedia->is_free) {
            abort(403);
        }

        return response()->file($path);
    }
}
