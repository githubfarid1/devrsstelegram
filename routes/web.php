<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaypalController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/help', function () {
    $isMobile = \Jenssegers\Agent\Facades\Agent::isMobile();
    $walink = ($isMobile ? env('WA_MOBILE_URL') : env('WA_DESKTOP_URL')) . 'send?phone=' . env('WA_PHONE') . '&text=' . urlencode(sprintf(__('home.waask')));
    return view('help', ['walink' => $walink]);
})->name('help');

Route::get('/paypal/in', [PaypalController::class, 'paypal_in'])->name('paypals.in');
Route::get('/paypal/euro', [PaypalController::class, 'paypal_euro'])->name('paypals.euro');
Route::get('/paypal/usa', [PaypalController::class, 'paypal_usa'])->name('paypals.usa');
Route::get('/paypal/out', [PaypalController::class, 'paypal_out'])->name('paypals.payment');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/telegrams/{telegram}/edit', [TelegramController::class, 'edit'])->name('telegrams.edit');
    Route::patch('/telegrams/{telegram}/edit', [TelegramController::class, 'update'])->name('telegrams.update');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::delete('/service', [HomeController::class, 'service'])->name('service');

    Route::get('/password/edit', [UpdatePasswordController::class, 'edit'])->name('editpassword');
    Route::put('/password/edit', [UpdatePasswordController::class, 'updatePassword'])->name('updatepassword');
    Route::get('/users', [UserController::class, 'index2'])->name('users.index');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    //Route::get('/users/index2', [UserController::class, 'index2'])->name('users.index2');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    // Route::delete('/users/{user}/process', [UserController::class, 'process'])->name('users.process');
    Route::delete('/users/{user}/upgrade', [UserController::class, 'upgrade'])->name('users.upgrade');
    Route::delete('/users/{user}/downgrade', [UserController::class, 'downgrade'])->name('users.downgrade');
    Route::delete('/users/{user}/plus7', [UserController::class, 'plus7'])->name('users.plus7');

});
//Route::put('/email/verification-notification', [VerificationController::class, 'resend'])->name('verification.resend');
Auth::routes();
Route::get('auth/facebook', [App\Http\Controllers\Auth\LoginController::class, 'facebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'facebook_callback'])->name('auth.facebook_callback');
Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'google'])->name('auth.google');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'google_callback'])->name('auth.google_callback');

