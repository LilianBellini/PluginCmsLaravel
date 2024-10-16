<?php

use Lilian\PluginCmsLaravel\Controllers\Api\Post\ApiCategoryController;
use Lilian\PluginCmsLaravel\Controllers\Api\ApiNewsletterController;
use Lilian\PluginCmsLaravel\Controllers\Api\Post\ApiPostController;
use Lilian\PluginCmsLaravel\Controllers\Api\CommandController;
use Illuminate\Support\Facades\Route;




// Public Api Routes
Route::prefix('{locale?}')->group(function () {
    Route::apiResource('/posts', ApiPostController::class, ['only' => ['index', 'show']]);
    Route::get('/posts/slug/{slug}', [ApiPostController::class, 'showBySlug'])->name('posts.showBySlug');
    Route::get('/posts/findSlug/{slug}', [ApiPostController::class, 'changeLocaleSlug'])->name('posts.changeLocaleSlug');
    Route::apiResource('/categories', ApiCategoryController::class, ['only' => ['index', 'show']]);
});

Route::get('run-command', [CommandController::class, 'runCommand'])->middleware('DebugModeOnly');
Route::apiResource('/newsletters', ApiNewsletterController::class, ['only' => ['store']]);