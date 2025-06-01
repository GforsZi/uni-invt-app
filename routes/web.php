<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Middleware\CheckActivation;
use App\Http\Middleware\CheckRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['title' => 'Landing page']);
});
Route::get('/forbidden', function () {
    $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
    return view('forbidden', ['title' => 'Forbidden page', 'users' => $user]);
})->middleware(CheckActivation::class . ':0');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login_page'])->name('login');
    Route::post('/system/login', [AuthController::class, 'login_system']);
    Route::get('/register', [AuthController::class, 'register_page'])->name('register');
    Route::post('/system/register', [AuthController::class, 'register_system']);
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'home_page'])->name('home')->middleware(CheckActivation::class . ':1');
    Route::get('/dashboard', [DashboardController::class, 'dashboard_page'])->name('dashboard')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':sapras');

    Route::get('logout', [AuthController::class, 'logout_system'])->name('logout');
});
