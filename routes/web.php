<?php

use Illuminate\Support\Facades\Route;
use PixiiBomb\Core\Http\Controllers\DocumentationController;
use PixiiBomb\Core\Http\Controllers\WelcomeController;

Route::get('/pixii', [WelcomeController::class, 'welcome']);

Route::get('/docs/{package?}/{path?}', [DocumentationController::class, 'index'])
    ->where('path', '.*')
    ->name('docs');
