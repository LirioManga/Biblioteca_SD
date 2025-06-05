<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.post');
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::put('/recover-password', [PasswordController::class, 'recover'])->name('recover-password');
Route::get('/recover-password', [UserController::class, 'showRecoverForm'])->name('recover-password.form');
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register-user', [UserController::class, 'store'])->name('register-user');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [UserController::class, 'admin'])->name('admin');
    Route::get('/admin/inicio', [UserController::class, 'admin'])->name('admin');
    Route::get('/admin/estudantes', [UserController::class, 'admin'])->name('admin');
    Route::get('/admin/recursos', [UserController::class, 'admin'])->name('admin');
    Route::get('/admin/perfil', [UserController::class, 'admin'])->name('admin');
    
    /* -------------------------------------- Utilizadores ------------------------------------- */
    Route::post('/admin/utilizadores/registar', [UserController::class, 'store']);
    Route::get('/admin/utilizadores/visualizar', [UserController::class, 'show']);
    Route::put('/admin/utilizadores/actualizar', [UserController::class, 'update']);
    // Route::post('/admin/utilizadores/desativar/{id}', [UserController::class, 'destroy']);
    Route::get('/admin/utilizadores/buscar/{id}', [UserController::class, 'search']);

    /* -------------------------------------- Recursos ------------------------------------- */

    Route::post('/admin/recurso/registar', [ResourceController::class, 'store']);
    Route::get('/admin/recurso/visualizar', [ResourceController::class, 'show']);
    Route::put('/admin/recurso/actualizar', [ResourceController::class, 'update']);
    Route::delete('/admin/recurso/excluir/{id}', [ResourceController::class, 'destroy']);
    Route::get('/admin/recurso/buscar/{id}', [ResourceController::class, 'search']);
    Route::get('/admin/recurso/baixar/{id}', [ResourceController::class, 'download']);

    /* -------------------------------------- Testando middleware ------------------------------------- */

});

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/student', [UserController::class, 'student'])->name('student');
    Route::get('/student/inicio', [UserController::class, 'student'])->name('student');
    Route::get('/student/meus-recursos', [UserController::class, 'student'])->name('student');
    Route::get('/student/recursos', [UserController::class, 'student'])->name('student');
    Route::get('/student/perfil', [UserController::class, 'student'])->name('student');
    /* -------------------------------------- Recursos --------------------------------------- */


    /* -------------------------------------- Requisitar Recurso------------------------------- */
    Route::post('/student/recurso/devolver', [ReservationController::class, 'returnResource']);
    Route::post('/student/recurso/cancelar', [ReservationController::class, 'cancelReservation']);
    Route::post('/student/recurso/requisitar', [ReservationController::class, 'requestResource']);
    Route::post('/student/requisicoes/feitas-por-mim', [ReservationController::class, 'viewMyRequests']);
    Route::post('/student/requisicoes/para-meus-recursos', [ReservationController::class, 'viewRequestsToMyResources']);
    Route::post('/student/recurso/registar', [ResourceController::class, 'store']);
    Route::get('/student/recurso/visualizar', [ResourceController::class, 'myResources']);
    Route::get('/student/recursos/listar', [ResourceController::class, 'myResources']);
    Route::post('/student/recurso/actualizar/{id}', [ResourceController::class, 'update']);
    Route::get('/student/recurso/editar/{id}', [ResourceController::class, 'edit']);
    Route::delete('/student/recurso/excluir/{id}', [ResourceController::class, 'destroy']);
    Route::get('/student/recurso/buscar/{id}', [ResourceController::class, 'search']);
    Route::get('/student/recurso/baixar/{id}', [ResourceController::class, 'download']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
