<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index']);
Route::get('/orders/raw', [\App\Http\Controllers\OrderController::class, 'raw']);
Route::get('/orders/withcache', [\App\Http\Controllers\OrderController::class, 'withcache']);
