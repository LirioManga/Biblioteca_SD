<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/admin/utilizadores/registar', [UserController::class, 'store']);
Route::get('/admin/utilizadores/visualizar', [UserController::class, 'show']);
Route::put('/admin/utilizadores/actualizar', [UserController::class, 'update']);
Route::post('/admin/utilizadores/desativar/{id}', [UserController::class, 'destroy']);
Route::get('/admin/utilizadores/buscar/{id}', [UserController::class, 'search']);
