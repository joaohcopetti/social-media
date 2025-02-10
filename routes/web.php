<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('painel')->name('panel.')->group(function () {
    require __DIR__ . '/panel/panel-profile-routes.php';
    require __DIR__ . '/panel/panel-user-routes.php';
    require __DIR__ . '/panel/panel-my-account-routes.php';
});

require __DIR__ . '/main/profile-routes.php';
require __DIR__ . '/auth.php';
