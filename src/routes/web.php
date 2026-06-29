<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoicebankController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\DataController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/voicebanks', [VoicebankController::class, 'list']);
Route::get('/voicebanks/create', [VoicebankController::class, 'create']);
Route::get('/voicebanks/update/{voicebank}', [VoicebankController::class, 'update']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/voicebanks/put', [VoicebankController::class, 'put']);
Route::post('/voicebanks/patch/{voicebank}', [VoicebankController::class, 'patch']);
Route::post('/voicebanks/delete/{voicebank}', [VoicebankController::class, 'delete']);
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/songs', [SongController::class, 'list']);
Route::get('/songs/create', [SongController::class, 'create']);
Route::post('/songs/put', [SongController::class, 'put']);
Route::get('/songs/update/{song}', [SongController::class, 'update']);
Route::post('/songs/patch/{song}', [SongController::class, 'patch']);
Route::post('/songs/delete/{song}', [SongController::class, 'delete']);
Route::get('/data/get-top-songs', [DataController::class, 'getTopSongs']);
Route::get('/data/get-song/{song}', [DataController::class, 'getSong']);
Route::get('/data/get-related-songs/{song}', [DataController::class, 'getRelatedSongs']);