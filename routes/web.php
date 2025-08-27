<?php

  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLoginControlller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
   
Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
// Admin Login

Route::get('/admin/login', [AdminLoginControlller ::class, 'login'])->name('admin.login');

// end

Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class)->middleware('permission:role-list|role-edit|role-create|role-delete');
    // Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
