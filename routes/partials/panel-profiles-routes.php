<?php

use App\Http\Controllers\PanelProfileController;
use App\Http\Controllers\PanelProfileMediaController;

Route::prefix('perfis')->name('profiles.')->group(function () {
    Route::get('/', [PanelProfileController::class, 'index'])->name('index');
    Route::get('/novo', [PanelProfileController::class, 'create'])->name('create');
    Route::post('/novo', [PanelProfileController::class, 'store'])->name('store');
    Route::get('/{profile}/editar', [PanelProfileController::class, 'edit'])->name('edit');
    Route::patch('/{profile}', [PanelProfileController::class, 'update'])->name('update');
    Route::get('/{profile}/gerenciar-midias', [PanelProfileMediaController::class, 'edit'])->name('manage-media');
    Route::post('/{profile}/enviar-media', [PanelProfileMediaController::class, 'store'])->name('send-media');
    Route::post('/{profileMedia}/toggle-state', [PanelProfileMediaController::class, 'toggleState'])
        ->name('toggle-state');

    Route::delete('/{profileMedia}/deletar', [PanelProfileMediaController::class, 'destroy'])->name('delete-media');
});
