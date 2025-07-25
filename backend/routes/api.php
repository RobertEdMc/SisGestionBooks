<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\LibsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ExportController;

////// PARTE USER  //////

// Obtener perfil del usuario autenticado
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);

// Registro de usuario
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::post('/login', [AuthController::class, 'login']);

// Logout (requiere token válido)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

////// LIBS PART ////// 

Route::apiResource('libs', LibsController::class);

////// AUTORS PART ////// 

Route::apiResource('authors', AuthorController::class);

//// Exportar Excel /////

Route::get('export', [ExportController::class, 'exportAuthorsAndLibs']);



