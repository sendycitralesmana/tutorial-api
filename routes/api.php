<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);

// Post
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}/show', [PostController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    
    // Post
    Route::post('/posts/store', [PostController::class, 'store']);
    Route::patch('/posts/{id}/update', [PostController::class, 'update'])->middleware('pemilik-postingan');
    Route::delete('/posts/{id}/destroy', [PostController::class, 'destroy'])->middleware('pemilik-postingan');

    // Auth
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/logout', [AuthController::class, 'logout']);

});