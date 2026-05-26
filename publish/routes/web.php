<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use PixiiBomb\Core\Controllers\ThemeController;
use PixiiBomb\Core\Controllers\User\{LogoutController, RegisterController};
use PixiiBomb\Core\Controllers\User\DashboardController;
use PixiiBomb\Core\Controllers\User\LoginController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::patch('/dashboard/avatar', [DashboardController::class, 'patchAvatar'])
    ->middleware('auth')
    ->name('dashboard.avatar');

Route::prefix('theme')->group(function () {
    Route::get('/', [ThemeController::class, 'index'])->name('themes');
    Route::get('/buttons', [ThemeController::class, 'buttons']);
    Route::patch('/settings', [ThemeController::class, 'updateSettings'])
        ->middleware('auth')
        ->name('themes.settings');
});
