<?php

use App\Http\Controllers\PanelUserController;

Route::prefix('usuarios')->name('users.')->group(function () {
    Route::get('/', [PanelUserController::class, 'index'])->name('index');
    Route::post('/novo', [PanelUserController::class, 'store'])->name('store');
    Route::patch('/{user}/editar', [PanelUserController::class, 'update'])->name('update');
});
