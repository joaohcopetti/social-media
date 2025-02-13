<?php

use App\Http\Controllers\Panel\PanelMyAccountController;
use Illuminate\Support\Facades\Route;

Route::name('my-account.')->group(function () {
    Route::get('/minha-conta', [PanelMyAccountController::class, 'manage'])->name('edit');
    Route::patch('/minha-conta', [PanelMyAccountController::class, 'update'])->name('update');
});
