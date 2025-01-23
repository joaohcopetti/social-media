<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileMediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::name('profile.')->group(function () {
    Route::get('/{profile}', [ProfileController::class, 'index'])->name('index');
    Route::get('/{profile}/free', [ProfileController::class, 'free'])->name('free');
    Route::get('/{profile}/premium', [ProfileController::class, 'premium'])->name('premium');
    Route::get('/midia/{filename}', [ProfileMediaController::class, 'media'])->name('media');
});

require __DIR__ . '/auth.php';
