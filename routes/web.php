<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\HomeController;
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
    require __DIR__ . '/partials/panel-profiles-routes.php';
    require __DIR__ . '/partials/panel-users-routes.php';
    require __DIR__ . '/partials/panel-my-account-routes.php';
});

require __DIR__ . '/partials/profile-routes.php';
require __DIR__ . '/auth.php';
