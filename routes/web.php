<?php

use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckRoleLevel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([CheckRoleLevel::class, 'role.level:99999'])->group(function () {
    Route::get('/dasboard', [DashboardController::class, 'dashboard_page']);
});
