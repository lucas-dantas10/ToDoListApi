<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Task\TaskController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name("login");
Route::post('create-account', [UserController::class, 'store'])->name("user.store");

Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('current-user', [AuthController::class, 'getCurrentUser'])->name('current.user');

    Route::apiResource('category', CategoryController::class);

    Route::apiResource('task', TaskController::class);
    Route::post('tasks/filter', [TaskController::class, 'filterByDate'])->name('tasks.filter');
    Route::post('tasks/filter/name', [TaskController::class, 'filterByName'])->name('tasks.filter.name');
    Route::post('tasks/change-status', [TaskController::class, 'changeStatusTask'])->name('change.status');
});
