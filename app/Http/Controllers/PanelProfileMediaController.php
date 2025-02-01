<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Services\MediaService;
use Arr;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PanelProfileMediaController extends Controller
{
    public function edit(Profile $profile)
    {
        return Inertia::render('panel/media/ProfileMediaManagementView', [
            'profile' => $profile
        ]);
    }

    public function store(Profile $profile, Request $request)
    {
        $mime = Arr::first(explode('/', $request->file('file')->getMimeType()));

        if ($mime === 'image') {
            $filename = $request->file('file')->store('midias');
            $thumbnailFilename = app(MediaService::class)->generateThumbnail(
                storage_path('app/private/' . $filename)
            );
        } else if ($mime === 'video') {
            $filename = $request->file('file')->store('midias');
            $thumbnailFilename = $request
                ->file('thumbnailFile')
                ->storeAs('midias', pathinfo($filename, PATHINFO_FILENAME) . '_thumb' . '.' . 'png');
        }

        $profile->media()->create([
            'is_free' => $request->boolean('is_free'),
            'show_on_home' => $request->boolean('is_main'),
            'filename' => pathinfo($filename, PATHINFO_BASENAME),
            'thumbnail_filename' => pathinfo($thumbnailFilename, PATHINFO_BASENAME),
            'size' => $request->file('file')->getSize(),
            'order' => $request->input('index'),
            'type' => $mime
        ]);
    }
}
