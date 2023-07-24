<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Task\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name("login");
Route::post('create-account', [AuthController::class, 'store'])->name("login.store");

Route::middleware('auth:sanctum')->group(function() {
    Route::get('current-user', [AuthController::class, 'getCurrentUser'])->name('current.user');

    Route::resource('category', CategoryController::class);

    Route::resource('task', TaskController::class);
    Route::post('tasks/filter', [TaskController::class, 'filterByDate'])->name('tasks.filter');
    Route::post('tasks/filter/name', [TaskController::class, 'filterByName'])->name('categories.filter.name');
});
