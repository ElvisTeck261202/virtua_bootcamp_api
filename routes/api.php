<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user()->load(['roles', 'permissions']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('users', [UserController::class, 'index']);
    Route::post('user/create', [UserController::class, 'store']);
    Route::put('user/{uuid}', [UserController::class, 'update']);
    Route::delete('user/{uuid}', [UserController::class, 'destroy']);
});

Route::middleware(['permission:agregar posts'])->group(function () {
    Route::post('post', [PostController::class, 'store']);
});

Route::middleware(['permission:consultar posts'])->group(function () {
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{user_uuid}', [PostController::class, 'getPostsByUser']);
});

Route::middleware(['permission:agregar comentarios'])->group(function () {
    Route::post('comment', [CommentController::class, 'store']);
});

Route::middleware(['permission:eliminar comentarios'])->group(function () {
    Route::delete('comment/{comment_uuid}', [CommentController::class, 'destroy']);
});

Route::delete('comment/{comment_uuid}', [CommentController::class, 'destroy']);
