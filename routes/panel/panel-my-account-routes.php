<?php

use App\Enums\RolesEnum;
use App\Http\Controllers\Panel\PanelMyMediaController;
use App\Http\Controllers\Panel\PanelMyProfileController;
use App\Http\Controllers\Panel\PanelProfileController;
use Illuminate\Auth\Middleware\Authenticate;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\Panel\PanelMyAccountController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    Authenticate::class,
    RoleMiddleware::using([
        RolesEnum::ADMIN->value,
        RolesEnum::INFLUENCER->value
    ])
])->group(function () {
    Route::name('my-account.')->group(function () {
        Route::get('/minha-conta', [PanelMyAccountController::class, 'manage'])->name('edit');
        Route::patch('/minha-conta', [PanelMyAccountController::class, 'update'])->name('update');
    });

    Route::name('my-profile.')->group(function () {
        Route::get('/meu-perfil', [PanelMyProfileController::class, 'edit'])->name('edit');
        Route::patch('/meu-perfil', [PanelMyProfileController::class, 'update'])->name('update');
    });

    Route::name('my-media.')->group(function () {
        Route::get('/minhas-midias', [PanelMyMediaController::class, 'manage'])->name('manage');
        Route::post('/minhas-midias', [PanelMyMediaController::class, 'upload'])->name('upload');

        Route::delete('{profileMedia}/deletar', [PanelMyMediaController::class, 'delete'])
            ->name('delete');

        Route::post('/{profileMedia}/toggle-state', [PanelMyMediaController::class, 'toggleState'])
            ->name('toggle-state');
    });
});
