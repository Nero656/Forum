<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user', [userController::class, 'store']);

Route::post('/login', [userController::class, 'login']);

Route::middleware('auth:api')->post('/logout', [userController::class, 'logout']);

Route::get('/posts', [PostController::class, 'index']);

Route::middleware('auth:api')->post('/post/{user}', [PostController::class, 'store']);

Route::get('/post/popular', [PostController::class, 'PopuliarPosts']);

Route::get('/post/popular/5', [PostController::class, 'topPopuliarPosts']);

Route::patch('/post/like/{post}',[PostController::class, 'like']);

Route::patch('/post/update/{post}',[PostController::class, 'update']);

Route::delete('/post/delete/{post}',[PostController::class, 'delete']);
