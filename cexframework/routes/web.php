<?php

use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\UserController;
use Framework\Router\Route;

Route::post('/api/v1/user/login', LoginController::class . '@store');
Route::post('/api/v1/user/register', RegisterController::class . '@store');
Route::get('/api/v1/user/profile/:id', UserController::class . '@index');
