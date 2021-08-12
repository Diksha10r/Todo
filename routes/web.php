<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TodolistController;

Route::get('/', [WelcomeController::class, 'index']);


Route::group(['middleware'=>'auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dash');
    Route::get('/users/list', [TodolistController::class, 'index']);
    Route::post('/dashboard/store', [TodolistController::class, 'store']);
    Route::post('/dashboard/update', [TodolistController::class, 'update']);
    Route::post('/dashboard/delete', [TodolistController::class, 'destroy']);
    
    
    
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::post('/task/list', [TodolistController::class, 'get_task']);
// Route::get('/tasks/list', [TodolistController::class, 'index']);
// Route::get('/tasks/delete', [TodolistController::class, 'destroy']);
