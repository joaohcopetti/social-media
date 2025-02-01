<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ProfileMedia;
use App\Services\MediaService;
use Arr;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PanelProfileMediaController extends Controller
{
    public function edit(Profile $profile)
    {
        return Inertia::render('panel/media/ProfileMediaManagementView', [
            'profile' => $profile->load(['media'])
        ]);
    }

    public function store(Profile $profile, Request $request)
    {
        $storedMedia = $this->storeMedia($request);

        $media = $profile->media()->create([
            'is_free' => $request->boolean('is_free'),
            'show_on_home' => $request->boolean('is_main'),
            'filename' => pathinfo($storedMedia['filepath'], PATHINFO_BASENAME),
            'thumbnail_filename' => pathinfo($storedMedia['thumbnailFilepath'], PATHINFO_BASENAME),
            'size' => $request->file('file')->getSize(),
            'order' => $request->input('index'),
            'type' => $storedMedia['type']
        ]);

        return response()->json([
            'message' => 'Mídia enviada com sucesso!',
            'media' => $media
        ]);
    }

    private function storeMedia(Request $request)
    {
        $type = Arr::first(explode('/', $request->file('file')->getMimeType()));

        if ($type === 'image') {
            $filepath = $request->file('file')->store('midias');
            $thumbnailFilepath = app(MediaService::class)->generateThumbnail(
                storage_path("app/private/$filepath")
            );

            return [
                'type' => $type,
                'filepath' => $filepath,
                'thumbnailFilepath' => $thumbnailFilepath
            ];
        }

        if ($type === 'video') {
            $filepath = $request->file('file')->store('midias');
            $thumbnailFilename = pathinfo($filepath, PATHINFO_FILENAME) . '_thumb.png';

            $thumbnailFilepath = $request
                ->file('thumbnailFile')
                ->storeAs('midias', $thumbnailFilename);

            return [
                'type' => $type,
                'filepath' => $filepath,
                'thumbnailFilepath' => $thumbnailFilepath
            ];
        }

        throw new \Error('Media type not supported');
    }

    public function destroy(ProfileMedia $profileMedia)
    {
        $profileMedia->delete();
    }
}
