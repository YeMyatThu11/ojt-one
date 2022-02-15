<?php

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
Route::middleware('auth:api')->group(function () {
    Route::apiResource('/users', UserController::class);
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('{post}', [PostController::class, 'show'])->name('show');
        Route::post('/', [PostController::class, 'store'])->name('store');
    });
});