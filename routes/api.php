<?php

use Illuminate\Support\Facades\Route;

Route::post('/reset', [ResetController::class, 'reset']);
Route::get('/balance', [BalanceController::class, 'show']);
Route::post('/event', [EventController::class, 'store']);