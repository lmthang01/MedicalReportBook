<?php

use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
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

Route::group(['namespace' => 'Backend', 'prefix' => 'admin' ], function(){
    Route::get('', [BackendHomeController::class, 'index'])->name('get_admin.home');

    // Department
    Route::group(['prefix' => 'department'], function(){
        Route::get('', [DepartmentController::class, 'index'])->name('get_admin.department.index');

        Route::get('create', [DepartmentController::class, 'create'])->name('get_admin.department.create');
        Route::post('create', [DepartmentController::class, 'store'])->name('get_admin.department.store');

        Route::get('update/{id}', [DepartmentController::class, 'edit'])->name('get_admin.department.update');
        Route::post('update/{id}', [DepartmentController::class, 'update'])->name('get_admin.department.update');

        Route::get('delete/{id}', [DepartmentController::class, 'delete'])->name('get_admin.department.delete');
    });
});

Route::group(['namespace' => 'Frontend' ], function(){
    Route::get('', [HomeController::class, 'index'])->name('get.home');
});