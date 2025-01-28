<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanelProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileMediaController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('painel')->name('panel.')->middleware([
    Authenticate::class,
    RoleMiddleware::using([
        RoleEnum::ADMIN->value
    ])
])->group(function () {
    Route::name('profiles.')->prefix('perfis')->group(function () {
        Route::get('/', [PanelProfileController::class, 'index'])->name('index');
        Route::get('/novo', [PanelProfileController::class, 'create'])->name('create');
    });
});

Route::name('profile.')->group(function () {
    Route::get('/{profile}', [ProfileController::class, 'index'])->name('index');
    Route::get('/{profile}/free', [ProfileController::class, 'free'])->name('free');
    Route::get('/{profile}/premium', [ProfileController::class, 'premium'])->name('premium');
    Route::get('/midia/{filename}', [ProfileMediaController::class, 'media'])->name('media');
});

require __DIR__ . '/auth.php';
