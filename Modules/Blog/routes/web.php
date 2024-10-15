<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\app\Http\Controllers\NewsCategoryController;
use Modules\Blog\app\Http\Controllers\NewsController;

Route::middleware(['auth:admin', 'translation'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::resource('news', NewsController::class)->names('news');
        Route::put('/news/status-update/{id}', [NewsController::class, 'statusUpdate'])->name('news.status-update');

        Route::resource('news-category', NewsCategoryController::class)->names('news-category')->except('show');
        Route::put('/news-category/status-update/{id}', [NewsCategoryController::class, 'statusUpdate'])->name('news-category.status-update');

        Route::resource('news-comment', NewsCategoryController::class)->names('news-comment')->only(['index', 'show', 'destroy']);
        Route::put('/news-comment/status-update/{id}', [NewsCategoryController::class, 'statusUpdate'])->name('news-comment.status-update');
    });
