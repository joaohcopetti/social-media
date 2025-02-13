<?php

use App\Http\Controllers\Panel\PanelMyMediaController;
use Illuminate\Support\Facades\Route;

Route::name('my-media.')->group(function () {
    Route::get('/minhas-midias', [PanelMyMediaController::class, 'manage'])->name('manage');
    Route::post('/minhas-midias', [PanelMyMediaController::class, 'upload'])->name('upload');

    Route::delete('{profileMedia}/deletar', [PanelMyMediaController::class, 'delete'])
        ->name('delete');

    Route::post('/{profileMedia}/toggle-state', [PanelMyMediaController::class, 'toggleState'])
        ->name('toggle-state');
});
