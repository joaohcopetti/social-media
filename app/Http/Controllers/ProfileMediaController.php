<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileMedia;

class ProfileMediaController extends Controller
{
    public function media(string $filename)
    {
        $path = storage_path(ProfileMedia::$STORAGE_PATH . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
