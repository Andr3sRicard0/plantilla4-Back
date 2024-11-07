<?php

use App\Http\Controllers\gastosController;
use App\Http\Controllers\studentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//estudiante api
Route::get('/estudiante', [studentController::class, 'index']);
Route::get('/estudiante/{id}', [studentController::class, 'show']);
Route::post('/estudiante', [studentController::class, 'store']);
Route::put('/estudiante/{id}', [studentController::class, 'update']);
Route::delete('/estudiante/{id}', [studentController::class, 'destroy']);

//gastos api
Route::get('/gasto', [gastosController::class, 'index']);
Route::get('/gasto/{id}', [gastosController::class, 'show']);
Route::post('gasto', [gastosController::class, 'store']);
Route::put('gasto/{id}', [gastosController::class, 'update']);
Route::delete('gasto/{id}', [gastosController::class, 'destroy']);