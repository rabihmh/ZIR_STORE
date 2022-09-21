<?php

use App\Http\Controllers\Admin\categoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dash', function () {
    return view('dashboard');
})->middleware(['auth']);//return view  default dashboard of breeze authentication

Route::group(['middleware' => ['auth:admin'], 'as' => 'admin.', 'prefix' => 'admin/dashboard'], function () {
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('categories/trash', [categoriesController::class, 'trash'])->name('categories.trash');
    Route::put('categories/{category}/restore', [categoriesController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{category}/force-delete', [categoriesController::class, 'forceDelete'])->name('categories.force-delete');

    Route::resource('categories', categoriesController::class);
    Route::resource('products', ProductsController::class);


});
