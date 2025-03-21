<?php

use LilianBellini\PluginCmsLaravel\Controllers\Admin\NewsletterController;
use LilianBellini\PluginCmsLaravel\Controllers\Admin\RoleController;
use LilianBellini\PluginCmsLaravel\Controllers\Admin\SettingController;
use LilianBellini\PluginCmsLaravel\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;





Route::middleware(['auth', 'admin'])->name('admin.')->prefix('/admin')->group(function () {
    // This Roles can manage with Admin & Writers with specific policies.
    Route::resource('/user', UserController::class, ['except' => ['create', 'store', 'show']]);
    Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
    Route::resource('/role', RoleController::class, ['only' => ['index']]);
    Route::resource('/setting', SettingController::class, ['only' => ['index', 'update']]);
    Route::resource('/newsletters', NewsletterController::class);
});