<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// Rota publica
Route::post('/login', [LoginController::class, 'login'])->name('login');// POST - http://localhost:8000/api/login - { "email": "mujito@test.com", "password": "12345678" }

Route::get('/users', [UserController::class, 'index']); // GET - http://localhost:8000/api/users?page=1 ou 2 ou 3...

Route::get('/users/{user}', [UserController::class, 'show']); // GET - http://localhost:8000/api/users/2

Route::post('/users', [UserController::class, 'store']); // POST - http://localhost:8000/api/users

Route::put('/users/{user}', [UserController::class, 'update']); // PUT - http://localhost:8000/api/users/1

Route::delete('/users/{user}', [UserController::class, 'destroy']); // DELETE - http://localhost:8000/api/users/3

// Rota restrita
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/users', [UserController::class, 'index']);// GET - http://localhost:8000/api/users?page=1 ou 2 ou 3...


    // Apenas se estiver usuario Logado ele desloga nessa rota
    Route::post('/logout/{user}', [LoginController::class, 'logout']);// POST - http://localhost:8000/api/logout/1, 2, 3, ou 4... // passar paramentro a ser deslogado.
});
