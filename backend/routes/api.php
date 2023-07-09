<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
});
Route::fallback(function () {
    return 'Page Not Found';
});
Route::get('videos/{title}',[VideoController::class,'searchVideo']);
Route::get('/videos', [VideoController::class, 'index']);
Route::get('/videos/category/{id}', [VideoController::class, 'getVideoByCategory']);
Route::get('/videos/play/{id}', [VideoController::class, 'playVideo'])->name('video.play');