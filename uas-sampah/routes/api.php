<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrashController;

// Endpoint Edukasi
Route::get('/education', [TrashController::class, 'getEducationData']);

// Endpoint Statistik
Route::get('/statistics', [TrashController::class, 'getStatisticsData']);

// Endpoint Klasifikasi (POST karena upload file)
Route::post('/classify', [TrashController::class, 'classifyImage']);
