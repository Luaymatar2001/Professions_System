<?php

use App\Http\Controllers\admin\ProfessionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SpecialtiesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RolePermissionController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\UserPermissionController;
use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\CityController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('layouts.main');
// });

Route::prefix('admin')->group(function () {
    //login
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.checkLogin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

Route::prefix('admin')
    ->middleware(['auth:admin', 'roleAdmin'])->group(function () {

        //main Page
        Route::view('/', 'cms.temp');

        //specialities
        Route::get('/specialities/restore_index', [SpecialtiesController::class, 'index_restore'])->name('specialities.restore');
        Route::post('/specialities/restore/{id}', [SpecialtiesController::class, 'restore'])->name('specialities.restore_process');
        Route::resource('/specialities', SpecialtiesController::class);

        //professional
        Route::get('/professional/restore_index', [ProfessionController::class, 'index_restore'])->name('professional.restore');
        Route::post('/professional/restore/{id}', [ProfessionController::class, 'restore'])->name('professional.restore_process');
        Route::resource('/professional', ProfessionController::class);
        Route::resource('/cities', CityController::class);

        //Role and Permission
        Route::get('/role/delete/{id}', [RoleController::class, 'destroy']);
        Route::resource('/roles', RoleController::class);

        Route::get('/permission/delete/{id}', [PermissionController::class, 'destroy']);
        Route::resource('/permission', PermissionController::class);
        Route::resource('/users', UserController::class);

        Route::resource('user.permissions', UserPermissionController::class);
        Route::resource('role.permissions', RolePermissionController::class);
    });
