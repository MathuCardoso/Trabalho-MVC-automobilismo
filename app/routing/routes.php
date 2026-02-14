<?php

use App\controller\CategoriaController;
use App\controller\EquipeController;
use App\controller\HomeController;
use App\controller\PilotoController;
use App\routing\Route;

require_once __DIR__ . "/../../autoload.php";

Route::get('/', [HomeController::class, 'index']);

//PILOTOS
Route::get('/pilotos', [PilotoController::class, 'index']);
Route::post('/pilotos', [PilotoController::class, 'create']);
Route::delete('/pilotos', [PilotoController::class, 'destroy']);
Route::put('/pilotos', [PilotoController::class, 'update']);

//EQUIPES
Route::get('/equipes', [EquipeController::class, 'index']);
Route::post('/equipes', [EquipeController::class, 'create']);
Route::delete('/equipes', [EquipeController::class, 'destroy']);
Route::put('/equipes', [EquipeController::class, 'update']);

//CATEGORIAS
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'create']);
Route::delete('/categorias', [CategoriaController::class, 'destroy']);
Route::put('/categorias', [CategoriaController::class, 'update']);