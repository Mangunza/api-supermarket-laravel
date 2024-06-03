<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/users', [UserController::class, 'index']); // GET - http://localhost:8000/api/users?page=1 ou 2 ou 3...

Route::get('/users/{user}', [UserController::class, 'show']); // GET - http://localhost:8000/api/users/2

Route::post('/users', [UserController::class, 'store']); // POST - http://localhost:8000/api/users

Route::put('/users/{user}', [UserController::class, 'update']); // PUT - http://localhost:8000/api/users/1

Route::delete('/users/{user}', [UserController::class, 'destroy']); // DELETE - http://localhost:8000/api/users/3
