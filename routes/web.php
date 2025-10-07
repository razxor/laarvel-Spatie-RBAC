<?php

  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLoginControlller;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
   
Route::get('/', function () {
    return view('welcome');
});
  
// Route::get('/', [AdminLoginControlller::class, 'showLoginForm'])->name('login');


Auth::routes();
// Admin Login

// Route::get('/admin', [AdminLoginControlller ::class, 'showLoginForm'])->name('adminLogin');

// end

Route::get('/db', [AdminDashboardController ::class, 'dashboard'])->name('adminDashboard');
Route::get('/roles', [AdminDashboardController ::class, 'roles'])->name('adminRoles');  

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest-only admin login routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminLoginControlller::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginControlller::class, 'login'])->name('login.post');        
    });

    // Protected admin areaA
    Route::middleware(['auth', 'role:Admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminLoginControlller::class, 'logout'])->name('logout');    

    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    # This kind of middleware check is not correct when use Route::resource() , but fine-grained control (e.g., different permissions for different actions),
    // Route::resource('roles', RoleController::class)->middleware('permission:role-list|role-edit|role-create|role-delete');
    Route::resource('roles', RoleController::class);
    // Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
