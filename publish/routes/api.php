<?php

use Illuminate\Support\Facades\Route;
use PixiiBomb\Core\Controllers\Api\{ChatbotEndpointsController, AiSetupController, RoleController, ThemeController, UserController};

Route::post('/auth/login', [UserController::class, 'login']);

Route::post('/users', [UserController::class, 'create']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [UserController::class, 'logout']);
    Route::get('/auth/me', [UserController::class, 'me']);

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'getAll']);
        Route::get('/{id}', [UserController::class, 'get']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::patch('/{id}', [UserController::class, 'patch']);
        Route::patch('/{id}/avatar', [UserController::class, 'patchAvatar']);
        Route::delete('/', [UserController::class, 'deleteAll']);
        Route::delete('/{id}', [UserController::class, 'delete']);
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'getAll']);
        Route::get('/{id}', [RoleController::class, 'get']);
        Route::post('/', [RoleController::class, 'create']);
        Route::put('/{id}', [RoleController::class, 'update']);
        Route::patch('/{id}', [RoleController::class, 'patch']);
        Route::delete('/', [RoleController::class, 'deleteAll']);
        Route::delete('/{id}', [RoleController::class, 'delete']);
    });

    Route::prefix('themes')->group(function () {
        Route::get('/', [ThemeController::class, 'getAll']);
        Route::get('/{id}', [ThemeController::class, 'get']);
        Route::post('/', [ThemeController::class, 'create']);
        Route::put('/{id}', [ThemeController::class, 'update']);
        Route::patch('/{id}', [ThemeController::class, 'patch']);
        Route::delete('/', [ThemeController::class, 'deleteAll']);
        Route::delete('/{id}', [ThemeController::class, 'delete']);
    });

    Route::get('/chat', [ChatbotEndpointsController::class, 'chat']);
});

Route::prefix('ai')->group(function (){
    Route::get('/health-check', [AiSetupController::class, 'healthCheck']);
    Route::get('/verify-ai-sdk', [AiSetupController::class, 'verifyAiSdk']);
});
