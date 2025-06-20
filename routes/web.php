<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/order',[OrderController::class. 'create'])->name('order.create');
    Route::post('/order',[OrderController::class.'store'])->name('order.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Users     
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');  // admin.users.index
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');  // admin.user.edit
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.user.update');   // admin.user.update
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy'); // admin.user.destroy
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    
    // Orders CRUD
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::put('/orders/{order}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
    Route::delete('/orders/{order}', [AdminController::class, 'deleteOrder'])->name('admin.orders.delete');

    // Menu CRUD
    Route::get('/menu', [MenuController::class, 'admin_index'])->name('admin.menu.index');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('admin.menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('admin.menu.store');
    Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('admin.menu.delete');
});
