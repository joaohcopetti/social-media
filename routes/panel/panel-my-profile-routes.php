<?php

use App\Http\Controllers\Panel\PanelMyProfileController;
use Illuminate\Support\Facades\Route;

Route::name('my-profile.')->group(function () {
    Route::get('/meu-perfil', [PanelMyProfileController::class, 'edit'])->name('edit');
    Route::patch('/meu-perfil', [PanelMyProfileController::class, 'update'])->name('update');
});
