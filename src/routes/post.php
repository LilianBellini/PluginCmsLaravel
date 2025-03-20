<?php

use LilianBellini\PluginCmsLaravel\Controllers\Post\CategoryController;
use LilianBellini\PluginCmsLaravel\Controllers\Post\PageController;
use LilianBellini\PluginCmsLaravel\Controllers\Post\PostController;
use LilianBellini\PluginCmsLaravel\Controllers\Post\TagController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'editor'])->prefix('/editor')->group(function () {
    // Routes pour les posts
    Route::resource('post', PostController::class)->except(['show']);
    Route::name('post.')->group( function (){
        Route::resource('/page', PageController::class);
        Route::get('/post/search', [PostController::class, 'search'])->name('post.search');
        Route::get('/post/slug-get', [PostController::class, 'getSlug'])->name('post.getslug');
    
        // Routes pour les catégories
        Route::get('/category/slug-get', [CategoryController::class, 'getSlug'])->name('category.getslug');
        Route::resource('category', CategoryController::class);
    
        // Routes pour les tags
        Route::resource('tag', TagController::class);
    }); 

});
