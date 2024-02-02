<?php

use App\Http\Controllers\SongController;
use App\Http\Controllers\SongLocalController;
use App\Http\Controllers\UserController;
use App\Models\SongLocal;
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

Route::post('/register', [UserController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function (){

    Route::get('/user', [UserController::class, 'show']);
    Route::get('/sanctum/csrf-cookie', function () {
        return response()->json(['csrf-token' => csrf_token()]);
    });
});

Route::middleware(['auth:sanctum'])->post('/uploadSong', [SongLocalController::class, 'uploadSongFile']);

Route::get('/songs', [SongController::class, 'index']);
Route::get('/localSongs', [SongLocalController::class, 'index']);
Route::get('/localSongs/getSong', [SongLocalController::class, 'getLocalAudioFile']);
Route::get('/fetchSongFile', [SongController::class, 'getAudioFile']);
