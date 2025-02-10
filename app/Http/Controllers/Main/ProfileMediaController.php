<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\ProfileMedia;
use Str;
use App\Http\Controllers\Controller;

class ProfileMediaController extends Controller
{
    public function media(string $filename)
    {
        $profileMedia = ProfileMedia::where('filename', $filename)
            ->orWhere('thumbnail_filename', $filename)
            ->first();

        if (!$profileMedia) {
            abort(404);
        }

        $mediaPath = Str::contains($filename, '_thumb')
            ? $profileMedia->thumbnail_filename
            : $profileMedia->filename;

        $filepath = storage_path('app/private/midias/' . $mediaPath);

        return response()->file($filepath);
    }
}
