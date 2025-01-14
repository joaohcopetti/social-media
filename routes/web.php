<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index']);

Route::prefix('perfil')->name('profile.')->group(function () {
    Route::get('/{slug}', [ProfileController::class, 'index'])->name('index');
});

require __DIR__ . '/auth.php';
