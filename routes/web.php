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
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');
Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');
Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::post('posts/store', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

Route::resource('categories', CategoryController::class);

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('auth');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('auth');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show')->middleware('auth');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->middleware('auth');
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('auth');
Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth');

Auth::routes();
Route::get('/', [PostController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');