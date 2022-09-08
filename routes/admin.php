<?php

use App\Http\Controllers\Admin\categoriesController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dash', function () {
    return view('dashboard');
})->middleware(['auth']);//return view  default dashboard of breeze authentication

Route::group(['middleware' => ['auth'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', categoriesController::class);
});
