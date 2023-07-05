<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name("login");
Route::post('create-account', [AuthController::class, 'store'])->name("login.store");

// Route::middleware('auth:sanctum')->group(function() {
    
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
