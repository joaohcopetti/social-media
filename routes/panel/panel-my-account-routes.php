<?php

use App\Enums\RolesEnum;
use Illuminate\Auth\Middleware\Authenticate;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\Panel\PanelMyAccountController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::middleware([
        Authenticate::class,
        RoleMiddleware::using([
            RolesEnum::ADMIN->value,
            RolesEnum::INFLUENCER->value
        ])
    ])->group(function () {
        Route::get('/minha-conta', [PanelMyAccountController::class, 'myAccount'])->name('my-account');
        Route::patch('/minha-conta', [PanelMyAccountController::class, 'myAccountUpdate'])
            ->name('my-account-update');

        Route::get('/meu-perfil', [PanelMyAccountController::class, 'myProfile'])->name('my-profile');
        Route::patch('/meu-perfil', [PanelMyAccountController::class, 'myProfileUpdate'])
            ->name('my-profile-update');

        Route::get('/minhas-midias', [PanelMyAccountController::class, 'myMedia'])->name('my-media');
        Route::post('/minhas-midias', [PanelMyAccountController::class, 'myMediaUpdate'])
            ->name('my-media-upload');

        Route::delete('{profileMedia}/deletar', [PanelMyAccountController::class, 'myMediaDelete'])
            ->name('my-media-delete');

        Route::post('/{profileMedia}/toggle-state', [PanelMyAccountController::class, 'myMediaToggleState'])
            ->name('my-media-toggle-state');
    });
});
