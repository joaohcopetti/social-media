<?php

use App\Http\Controllers\Panel\PanelMySubscriptionsController;
use Illuminate\Support\Facades\Route;

Route::get('/minhas-assinaturas', [PanelMySubscriptionsController::class, 'index'])
    ->name('my-subscriptions.index');

Route::post('/minhas-assinaturas/{profile}/cancelar', [PanelMySubscriptionsController::class, 'cancel'])
    ->name('my-subscriptions.cancel');
