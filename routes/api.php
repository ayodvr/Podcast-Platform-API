<?php

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

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PodcastController;
use App\Http\Controllers\Api\EpisodeController;

Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
    Route::apiResource('podcasts', PodcastController::class)->only(['index', 'show']);
    Route::get('podcasts/{podcast}/episodes', [EpisodeController::class, 'byPodcast']);
    Route::get('episodes/{episode}', [EpisodeController::class, 'show']);
});

