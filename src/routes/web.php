<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoicebankController;

Route::get('/', [HomeController::class,'index']);

Route::get('/voicebanks', [VoicebankController::class,'list']);
Route::get('/voicebanks/create', [VoicebankController::class, 'create']);
Route::post('/voicebanks/put', [VoicebankController::class, 'put']);
Route::get('/voicebanks/update/{voicebank}', [VoicebankController::class, 'update']);
Route::post('/voicebanks/patch/{voicebank}', [VoicebankController::class, 'patch']);
Route::post('/voicebanks/delete/{voicebank}', [VoicebankController::class, 'delete']);