<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index']);

Route::name('profile.')->group(function () {
    Route::get('/{slug}', [ProfileController::class, 'index'])->name('index');
    Route::get('/{slug}/free', [ProfileController::class, 'free'])->name('free');
    Route::get('/{slug}/premium', [ProfileController::class, 'premium'])->name('premium');
});

require __DIR__ . '/auth.php';
