<?php

use App\Http\Controllers\ProfileMediaController;
use App\Http\Controllers\ProfileController;

Route::name('profile.')->group(function () {
    Route::get('/{profile}', [ProfileController::class, 'index'])->name('index');
    Route::get('/{profile}/free', [ProfileController::class, 'free'])->name('free');
    Route::get('/{profile}/premium', [ProfileController::class, 'premium'])->name('premium');
    Route::get('/midias/{filename}', [ProfileMediaController::class, 'media'])->name('media');
});
