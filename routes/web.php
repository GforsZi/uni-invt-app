<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Middleware\CheckRoleLevel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login_page'])->name('login');
    Route::post('/system/login', [AuthController::class, 'login_system']);
    Route::get('/register', [AuthController::class, 'register_page'])->name('register');
    Route::post('/system/register', [AuthController::class, 'register_system']);
});




Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'home_page'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'dashboard_page'])->name('dashboard');

    Route::get('logout', [AuthController::class, 'logout_system'])->name('logout');
});
