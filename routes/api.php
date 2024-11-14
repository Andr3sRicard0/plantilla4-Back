<?php

use App\Http\Controllers\gastosController;
use App\Http\Controllers\studentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

//Crear Token comentada ya que genero el token
//Route::get('/generate-token', [TokenController::class, 'generateToken']);


//estudiante api
Route::get('/estudiante', [studentController::class, 'index']);
Route::get('/estudiante/{id}', [studentController::class, 'show']);
Route::middleware('auth:sanctum')->post('/estudiante', [studentController::class, 'store']);
Route::middleware('auth:sanctum')->put('/estudiante/{id}', [studentController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/estudiante/{id}', [studentController::class, 'destroy']);

//gastos api
Route::get('/gasto', [gastosController::class, 'index']);
Route::get('/gasto/{id}', [gastosController::class, 'show']);
Route::middleware('auth:sanctum')->post('gasto', [gastosController::class, 'store']);
Route::middleware('auth:sanctum')->put('gasto/{id}', [gastosController::class, 'update']);
Route::middleware('auth:sanctum')->delete('gasto/{id}', [gastosController::class, 'destroy']);