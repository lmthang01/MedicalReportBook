<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login admin
Route::group(['namespace' => 'Backend', 'prefix' => 'auth'], function(){
    Route::get('login', [AuthController::class, 'login'])->name('get_admin.login');
    Route::post('login', [AuthController::class, 'postLogin']);
});

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'check.login.admin'], function(){
    Route::get('', [BackendHomeController::class, 'index'])->name('get_admin.home');

    // Đăng xuất login
    Route::get('logout', [AuthController::class, 'logout'])->name('get_admin.logout'); 

    // Department
    Route::group(['prefix' => 'department'], function(){
        Route::get('', [DepartmentController::class, 'index'])->name('get_admin.department.index');

        Route::get('create', [DepartmentController::class, 'create'])->name('get_admin.department.create');
        Route::post('create', [DepartmentController::class, 'store'])->name('get_admin.department.store');

        Route::get('update/{id}', [DepartmentController::class, 'edit'])->name('get_admin.department.update');
        Route::post('update/{id}', [DepartmentController::class, 'update'])->name('get_admin.department.update');

        Route::get('delete/{id}', [DepartmentController::class, 'delete'])->name('get_admin.department.delete');
    });

    // Staff
    Route::group(['prefix' => 'staff'], function(){
        Route::get('', [StaffController::class, 'index'])->name('get_admin.staff.index');

        Route::get('create', [StaffController::class, 'create'])->name('get_admin.staff.create');
        Route::post('create', [StaffController::class, 'store'])->name('get_admin.staff.store');

        Route::get('update/{id}', [StaffController::class, 'edit'])->name('get_admin.staff.update');
        Route::post('update/{id}', [StaffController::class, 'update'])->name('get_admin.staff.update');

        Route::get('delete/{id}', [StaffController::class, 'delete'])->name('get_admin.staff.delete');
    });

     // Location
     Route::group(['prefix' => 'location'], function(){
        Route::get('district', [LocationController::class, 'district'])->name('get_admin.location.district');
        Route::get('ward', [LocationController::class, 'ward'])->name('get_admin.location.ward');
    });

    // User
    Route::group(['prefix' => 'user'], function(){
        Route::get('', [UserController::class, 'index'])->name('get_admin.user.index');

        Route::get('create', [UserController::class, 'create'])->name('get_admin.user.create');
        Route::post('create', [UserController::class, 'store'])->name('get_admin.user.store');

        Route::get('update/{id}', [UserController::class, 'edit'])->name('get_admin.user.update');
        Route::post('update/{id}', [UserController::class, 'update'])->name('get_admin.user.update');

        Route::get('delete/{id}', [UserController::class, 'delete'])->name('get_admin.user.delete');
    });
});

Route::group(['namespace' => 'Frontend' ], function(){
    Route::get('', [HomeController::class, 'index'])->name('get.home');
});