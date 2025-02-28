<?php

namespace App\Http\Controllers\Main;

use App\Models\ProfileMedia;
use Auth;
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

        $profile = $profileMedia->profile;
        $user = Auth::user();

        $mediaPath = Str::contains($filename, '_thumb')
            ? $profileMedia->thumbnail_filename
            : $profileMedia->filename;

        $filepath = storage_path('app/private/midias/' . $mediaPath);

        if (
            $profileMedia->is_free
            || $user?->subscribedToProfile($profile)
            || $profile->user_id === $user?->id
        ) {
            return response()->file($filepath);
        }

        return abort(403);
    }
}
