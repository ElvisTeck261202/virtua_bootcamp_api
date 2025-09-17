<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('users', [UserController::class, 'index']);
    Route::post('user/create', [UserController::class, 'store']);
    Route::put('user/{uuid}', [UserController::class, 'update']);
    Route::delete('user/{uuid}', [UserController::class, 'destroy']);
});

