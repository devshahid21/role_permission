<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
      /// permission
    Route::get('/permission/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permission', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permission/edit{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permission/update{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permission/delete{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

      /// role
    Route::get('/role/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/store1', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/role', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/role/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/role/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    
    /// article
    Route::get('/article/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/store2', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/article', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/article/update/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/article/delete/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy'); 
    
       
    /// user
    Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('users.update');
    




});

require __DIR__.'/auth.php';
