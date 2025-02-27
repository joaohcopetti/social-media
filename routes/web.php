<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Enums\RolesEnum;

Route::get('/test', function () {
    /**
     * @var \App\Models\User
     */
    $user = Auth::user();
    // dd($user);;
    return $user->subscribedToPrice('price_1Qx0CiG8sEYWxOnlvB7b7aag') ? 'true' : 'false';
    // return $user->invoicesIncludingPending();
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('painel')->name('panel.')->group(function () {
    Route::middleware([
        Authenticate::class,
        RoleMiddleware::using([RolesEnum::ADMIN->value])
    ])->group(function () {
        require __DIR__ . '/panel/panel-profile-routes.php';
        require __DIR__ . '/panel/panel-user-routes.php';
    });

    Route::middleware([
        Authenticate::class,
        RoleMiddleware::using([RolesEnum::INFLUENCER->value])
    ])->group(function () {
        require __DIR__ . '/panel/panel-my-profile-routes.php';
        require __DIR__ . '/panel/panel-my-media-routes.php';
    });

    Route::middleware([Authenticate::class])->group(function () {
        require __DIR__ . '/panel/panel-my-account-routes.php';

        Route::middleware([RoleMiddleware::using([RolesEnum::CUSTOMER->value])])->group(function () {
            require __DIR__ . '/panel/panel-my-subscription-routes.php';
        });
    });
});

require __DIR__ . '/main/profile-routes.php';
require __DIR__ . '/auth.php';
