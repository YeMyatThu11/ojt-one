<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::middleware(['auth'])->group(function () {
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');
});

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
});

Auth::routes();
Route::get('/', [PostController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');