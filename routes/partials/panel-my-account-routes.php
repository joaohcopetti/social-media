<?php

use App\Enums\RolesEnum;
use App\Http\Controllers\PanelMyAccountController;
use Illuminate\Auth\Middleware\Authenticate;
use Spatie\Permission\Middleware\RoleMiddleware;

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
        Route::get('/minhas-midias', [PanelMyAccountController::class, 'myMedias'])->name('my-media');
    });
});
