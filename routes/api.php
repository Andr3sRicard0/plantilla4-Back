<?php

use App\Http\Controllers\studentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//estudiante api
Route::get('/estudiante', [studentController::class, 'index']);
Route::get('/estudiante/{id}', [studentController::class, 'show']);
Route::post('/estudiante', [studentController::class, 'store']);
Route::put('/estudiante/{id}', [studentController::class, 'update']);
Route::delete('/estudiante/{id}', [studentController::class, 'destroy']);

