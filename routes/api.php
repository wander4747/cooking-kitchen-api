<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\RecipeController;
use App\Http\Controllers\admin\TipController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::apiResources([
            'categories' => CategoryController::class,
            'recipes' => RecipeController::class,
            'tips' => TipController::class,
            'users' => UserController::class
        ]);    
    });
  });

