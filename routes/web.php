<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
  Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');
  Route::post('/', [AdminAuthController::class, 'login']);
});

Route::group(['middleware' => ['auth', 'admin']], function () {
  Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

  Route::get('admin/edit', [AdminController::class, 'edit'])->name('admin.edit');
  Route::put('admin/update', [AdminController::class, 'update'])->name('admin.update');

  Route::resource('books', BookController::class);
  Route::resource('categories', CategoryController::class);
});
