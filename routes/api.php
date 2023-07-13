<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name("login");
Route::post('create-account', [AuthController::class, 'store'])->name("login.store");

Route::middleware('auth:sanctum')->group(function() {
    Route::get('current-user', [AuthController::class, 'getCurrentUser'])->name('current.user');

    Route::get('categories', [CategoryController::class, 'index'])->name('category');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
