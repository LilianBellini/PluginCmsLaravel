<?php

use LilianBellini\PluginCmsLaravel\Controllers\Admin\NewsletterController;
use LilianBellini\PluginCmsLaravel\Controllers\Admin\RoleController;
use LilianBellini\PluginCmsLaravel\Controllers\Admin\SettingController;
use LilianBellini\PluginCmsLaravel\Controllers\Admin\UserController;
use LilianBellini\PluginCmsLaravel\Controllers\Admin\Seo\SeoProfileController;
use LilianBellini\PluginCmsLaravel\Controllers\Admin\Google\GoogleCredentialController;
use LilianBellini\PluginCmsLaravel\Controllers\Admin\ArticleGenerationController;
use LilianBellini\PluginCmsLaravel\Controllers\CityController;
use LilianBellini\PluginCmsLaravel\Controllers\SectorController;
use LilianBellini\PluginCmsLaravel\Controllers\PageController;
use Illuminate\Support\Facades\Route;





Route::middleware(['auth', 'admin'])->name('admin.')->prefix('/admin')->group(function () {
    // This Roles can manage with Admin & Writers with specific policies.
    Route::resource('/user', UserController::class, ['except' => ['create', 'store', 'show']]);
    Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
    Route::resource('/role', RoleController::class, ['only' => ['index']]);
    Route::resource('/setting', SettingController::class, ['only' => ['index', 'update']]);
    Route::resource('/newsletters', NewsletterController::class);


    Route::get('credentials', [GoogleCredentialController::class, 'edit'])->name('google.credentials.edit');
    Route::post('credentials', [GoogleCredentialController::class, 'update'])->name('google.credentials.update');


    Route::get('seo', [SeoProfileController::class, 'edit'])->name('seo.edit');
    Route::put('seo', [SeoProfileController::class, 'update'])->name('seo.update');

    Route::get('generate/seo', [ArticleGenerationController::class, 'generateSeo'])
        ->name('generate.seo');

    Route::get('generate/news', [ArticleGenerationController::class, 'generateNews'])
        ->name('generate.news');


    Route::resource('city', CityController::class)->names('page.city')->except(['show']);
    Route::resource('sector', SectorController::class)->names('page.sector')->except(['show']); 
    Route::resource('page', PageController::class)->names('page')->except(['show']); 

});

Route::get('/google/callback', action: [GoogleCredentialController::class, 'handleGoogleCallback'])->name('google.callback');
