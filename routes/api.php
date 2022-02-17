<?php

use App\Http\Controllers\api\AdminController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/access_denied', function () {
    return response()->json(['message' => 'access denied'], 403);
})->name('access_denied');

Route::middleware('auth:api')->group(function () {
    Route::prefix('/user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index')->middleware('admin');
        Route::get('{user}', [UserController::class, 'show'])->name('show');
        Route::put('{user}', [UserController::class, 'update'])->name('update')->middleware('user');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy')->middleware('admin');
    });
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('{post}', [PostController::class, 'show'])->name('show');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::put('{post}', [PostController::class, 'update'])->name('update')->middleware('owner');
        Route::delete('{post}', [PostController::class, 'destroy'])->name('destroy')->middleware('owner');
    });
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('{category}', [CategoryController::class, 'show'])->name('show');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::put('{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
        Route::get('/posts', [AdminController::class, 'showPosts'])->name('posts');
        Route::get('/users', [AdminController::class, 'showUsers'])->name('users');
    });
});