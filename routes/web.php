<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Middleware\CheckRoleLevel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login_page']);
Route::post('/system/login', [AuthController::class, 'login_system']);
Route::get('/register', [AuthController::class, 'register_page']);
Route::post('/system/register', [AuthController::class, 'register_system']);
