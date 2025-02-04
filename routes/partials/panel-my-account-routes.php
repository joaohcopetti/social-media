<?php

use App\Http\Controllers\PanelMyAccountController;

Route::prefix('minha-conta')->name('my-account.')->group(function () {
    Route::get('/', [PanelMyAccountController::class, 'index'])->name('index');
    Route::patch('/editar', [PanelMyAccountController::class, 'update'])->name('update');
});
