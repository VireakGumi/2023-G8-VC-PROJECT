<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PlayListController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoPlayListController;
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
    Route::get('/playlist', [PlayListController::class, 'getPlayListOfUser']);
    Route::get('/user/videos', [VideoController::class, 'getVideosOfUser']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::resource('history', HistoryController::class);
    // Route::get('/history', [HistoryController::class, 'index']);
    Route::post('/playlist', [PlayListController::class, 'store']);
    Route::get('/playlistByID/{id}', [PlayListController::class, 'show']);
    Route::post('/add-video/playlist', [VideoPlayListController::class, 'store']);
    Route::delete('/videos/{id}', [VideoController::class, 'destroy']);
    Route::post('/videos/update/{id}', [VideoController::class, 'update']);
    Route::post('/likes', [LikeController::class, 'store']);
    Route::post('/comments', [CommentController::class, 'store']);
    Route::post('/videos', [VideoController::class, 'uploadVideo'])->name('video.upload');
});
Route::fallback(function () {
    return 'Page Not Found';
}); 
// Route::get('/playlistByID/{id}', [PlayListController::class, 'show']);

Route::get('/videos/{title}',[VideoController::class,'searchVideo']);
Route::get('/videos', [VideoController::class, 'index']);
Route::get('/video/id/{id}', [VideoController::class, 'show']);
Route::get('/videos/play/{id}', [VideoController::class, 'playVideo'])->name('video.play');
Route::get('/videos/image/{imagePath}', [VideoController::class, 'getImage'])->name('video.image');
Route::get('/videos/category/{id}', [VideoController::class, 'getVideoByCategory']);
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/user/videos/{id}', [VideoController::class, 'getVideosOfUserID']);
Route::get('/playlist/{id}', [PlayListController::class, 'getPlayListOfUserID']);
Route::get('/category/{id}', [CategoriesController::class, 'show']);
// Route::get('/videos/category/{id}', [VideoController::class, 'videoRecommendation'] );
Route::get('/likes/{id}', [LikeController::class, 'index']);
Route::get('/comments/{id}', [CommentController::class, 'index']);
Route::get('/videos/recommendation/{id}/{categories_id}', [VideoController::class, 'videoRecommendation'] );
Route::get('/videos/recommendationHomePage/{categories_id}', [VideoController::class, 'videoRecommendationHomePage'] );
Route::get('/videos/viewer/{id}', [VideoController::class, 'storeViewer'] );

