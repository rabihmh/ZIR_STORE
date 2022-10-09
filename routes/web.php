<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthenticationController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserType;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('cart', CartController::class);
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'store']);
    Route::get('auth/user/2fa', [TwoFactorAuthenticationController::class, 'index'])->name('front.2fa');
    Route::post('currency', [CurrencyConverterController::class, 'store'])->name('currency.store');
});
Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])->name('auth.social.login.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])->name('auth.social.login.callback');
Route::get('auth/{provider}/user', [SocialController::class, 'index']);
//require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
