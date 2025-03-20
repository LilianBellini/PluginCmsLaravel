<?php

use LilianBellini\PluginCmsLaravel\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

require __DIR__ . '/post.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [ProfileController::class, 'index'])->name('index');
});