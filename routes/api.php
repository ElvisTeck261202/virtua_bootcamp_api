<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user()->load(['roles', 'permissions']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('users', [UserController::class, 'index']);
    Route::post('user/create', [UserController::class, 'store']);
    Route::put('user/{uuid}', [UserController::class, 'update']);
    Route::delete('user/{uuid}', [UserController::class, 'destroy']);
});

Route::middleware(['permission:crear posts'])->group(function () {
    Route::post('post', [PostController::class, 'store']);
});

Route::middleware(['permission: consultar posts'])->group(function () {
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{user_uuid}', [PostController::class, 'getPostsByUser']);
});
