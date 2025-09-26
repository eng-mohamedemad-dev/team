<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RankingController as AdminRankingController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Public news routes
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');

// تم حذف Endpoint تهيئة المستخدم - النظام يعمل بتسجيل الدخول فقط

// API ranking demo endpoint (to be wired to DB later)
Route::get('/api/ranking', [RankingController::class, 'index']);

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin: news management
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.delete');

    Route::get('/ranking', [AdminRankingController::class, 'index'])->name('ranking.index');
    Route::get('/ranking/create', [AdminRankingController::class, 'create'])->name('ranking.create');
    Route::post('/ranking', [AdminRankingController::class, 'store'])->name('ranking.store');
    Route::get('/ranking/{ranking}/edit', [AdminRankingController::class, 'edit'])->name('ranking.edit');
    Route::put('/ranking/{ranking}', [AdminRankingController::class, 'update'])->name('ranking.update');
    Route::delete('/ranking/{ranking}', [AdminRankingController::class, 'destroy'])->name('ranking.delete');
    
    // Image management routes
    Route::get('/images', [App\Http\Controllers\Admin\ImageController::class, 'index'])->name('images.index');
    Route::post('/images', [App\Http\Controllers\Admin\ImageController::class, 'store'])->name('images.store');
    Route::put('/images/{image}', [App\Http\Controllers\Admin\ImageController::class, 'update'])->name('images.update');
    Route::delete('/images/{image}', [App\Http\Controllers\Admin\ImageController::class, 'destroy'])->name('images.destroy');
});
