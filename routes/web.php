<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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
Route::middleware(['auth', 'verify'])->group(function () {
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::delete('{post}', [PostController::class, 'destroy'])->middleware('owner')->name('destroy');
        Route::get('{post}', [PostController::class, 'show'])->name('show');
        Route::put('{post}', [PostController::class, 'update'])->name('update');
        Route::get('{post}/edit', [PostController::class, 'edit'])->middleware('owner')->name('edit');
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
        Route::get('/{user}/update_password_form', [UserController::class, 'updatePWForm'])->name('updatePWForm');
        Route::put('{user}/update_password', [UserController::class, 'updatePW'])->name('updatePW');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::put('{user}/changeRole', [UserController::class, 'changeRole'])->name('changeRole');
    });
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard/posts', [AdminController::class, 'index'])->name('admin.posts');
    Route::get('dashboard/user', [AdminController::class, 'showUser'])->name('admin.user');
});

Route::name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('loginForm')->middleware('guest');
    Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('register', [AuthController::class, 'registerForm'])->name('registerForm')->middleware('guest');
    Route::post('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
    Route::get('forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('forgot-password-form')->middleware('guest');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password')->middleware('guest');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('reset-password')->middleware('guest');
    Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('reset-password-form');
    Route::get('wait-verification', [AuthController::class, 'waitVerificationForm'])->name('wait-verification');
    Route::get('verify-mail/{token}/{userId}', [AuthController::class, 'verifyMail'])->name('verify-mail');
});

Route::get('/', [AuthController::class, 'rediectBasedOnRole']);
Route::get('/home', function () {
    return redirect()->route('posts.index');
});