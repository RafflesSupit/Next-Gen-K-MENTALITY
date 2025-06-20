<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/order',[OrderController::class. 'create'])->name('order.create');
    Route::post('/order',[OrderController::class.'store'])->name('order.store');
});

Route::middleware(['auth','admin'])->prefix('admin')->group(function () {

});


