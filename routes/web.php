<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ManageAccountController;
use App\Http\Controllers\Web\ManageAssetController;
use App\Http\Controllers\Web\ManageCategoryAssetController;
use App\Http\Controllers\Web\ManageDescriptionAssetController;
use App\Http\Controllers\Web\ManageLoanController;
use App\Http\Controllers\Web\ManageLocationController;
use App\Http\Controllers\Web\ManageOriginAssetController;
use App\Http\Controllers\Web\ManageReturnController;
use App\Http\Controllers\Web\ManageRoleController;
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
    Route::get('/home', [HomeController::class, 'home_page'])->name('home')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':0');

    Route::get('/dashboard', [DashboardController::class, 'dashboard_page'])->name('dashboard')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');

    Route::get('/profile', [HomeController::class, 'profile_page'])->name('profile')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':0');

    Route::get('/admin/profile', [HomeController::class, 'admin_profile_page'])->name('admin_profile')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');

    Route::get('/manage/account', [ManageAccountController::class, 'manage_account_page'])->name('manage_account')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/account/{id}/detail', [ManageAccountController::class, 'detail_account_page'])->name('detail_account')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/account/add', [ManageAccountController::class, 'add_account_page'])->name('add_account')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/account/{id}/edit', [ManageAccountController::class, 'update_account_page'])->name('edit_account')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');

    Route::get('/manage/role', [ManageRoleController::class, 'manage_role_page'])->name('manage_role')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/role/add', [ManageRoleController::class, 'add_role_page'])->name('add_role')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/role/{id}/edit', [ManageRoleController::class, 'update_role_page'])->name('edit_role')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');

    Route::get('/manage/asset', [ManageAssetController::class, 'manage_asset_page'])->name('manage_asset')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/asset/{id}/detail', [ManageAssetController::class, 'detail_asset_page'])->name('detail_asset')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/asset/add', [ManageAssetController::class, 'add_asset_page'])->name('add_asset')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/asset/{id}/edit', [ManageAssetController::class, 'update_asset_page'])->name('edit_asset')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');

    Route::get('/manage/asset/category', [ManageCategoryAssetController::class, 'manage_asset_category_page'])->name('manage_asset_category')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/asset/category/add', [ManageCategoryAssetController::class, 'add_asset_category_page'])->name('add_asset_category')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/asset/category/{id}/edit', [ManageCategoryAssetController::class, 'edit_asset_category_page'])->name('edit_asset_category')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');

    Route::get('/manage/asset/origin', [ManageOriginAssetController::class, 'manage_asset_origin_page'])->name('manage_asset_origin')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/asset/origin/add', [ManageOriginAssetController::class, 'add_asset_origin_page'])->name('add_asset_origin')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/asset/origin/{id}/edit', [ManageOriginAssetController::class, 'update_asset_origin_page'])->name('edit_asset_origin')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');

    Route::get('/manage/location', [ManageLocationController::class, 'manage_location_page'])->name('manage_location')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/location/view', [ManageLocationController::class, 'view_all_location_page'])->name('manage_location')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/location/{id}/detail', [ManageLocationController::class, 'detail_location_page'])->name('detail_location')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/location/add', [ManageLocationController::class, 'add_location_page'])->name('add_location')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/location/{id}/edit', [ManageLocationController::class, 'update_location_page'])->name('edit_location')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');

    Route::get('/manage/loan', [ManageLoanController::class, 'manage_loan_page'])->name('manage_loan')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/loan/{id}/detail', [ManageLoanController::class, 'detail_loan_page'])->name('detail_loan')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');

    Route::get('/manage/return', [ManageReturnController::class, 'manage_return_page'])->name('manage_return')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');
    Route::get('/manage/return/{id}/detail', [ManageReturnController::class, 'detail_return_page'])->name('detail_return')->middleware(CheckActivation::class . ':1')->middleware(CheckRole::class . ':1');

    Route::get('logout', [AuthController::class, 'logout_system'])->name('logout');
});

// Route::middleware('auth')->group(function () {
//     Route::post();
//     Route::put();
//     Route::delete();
// });
