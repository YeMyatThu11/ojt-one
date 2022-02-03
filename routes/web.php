<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::delete('{post}', [PostController::class, 'destroy'])->name('destroy');
        Route::get('{post}', [PostController::class, 'show'])->name('show');
        Route::put('{post}', [PostController::class, 'update'])->name('update');
        Route::get('{post}/edit', [PostController::class, 'edit'])->name('edit');
        Route::post('store', [PostController::class, 'store'])->name('store');
    });
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::delete('{category}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::get('{category}', [CategoryController::class, 'show'])->name('show');
        Route::put('{category}', [CategoryController::class, 'update'])->name('update');
        Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
    });
    Route::get('{user}/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::middleware(['user'])->prefix('user')->name('user.')->group(function () {
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit')->middleware('user');
        Route::put('{user}', [UserController::class, 'update'])->name('update');
        Route::get('/{user}/reset_password_form', [UserController::class, 'resetPWForm'])->name('resetPWForm');
        Route::put('{user}/reset_password', [UserController::class, 'resetPW'])->name('resetPW');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Auth::routes();
Route::get('/', [PostController::class, 'index']);
Route::get('/home', function () {
    return redirect()->route('posts.index');
});