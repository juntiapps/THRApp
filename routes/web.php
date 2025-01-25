<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\SocialiteController; // Pastikan Anda membuat controller ini
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\Master\MasterEwalletController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/google', [SocialiteController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

//admin flow
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/home', [AdminDashboard::class, 'index'])->name('admin_home');
    Route::resource('users',UserController::class)->only(['index','destroy']);
    Route::group(['prefix' => 'master'], function () {
        Route::resource('ewallet',MasterEwalletController::class)->except(['show','delete']);
    });
});

//user flow
Route::group(['middleware' => ['auth', 'user',], 'prefix' => 'user'], function () {
    Route::get('/home', [UserDashboard::class, 'index'])->name('user_home');
   });
Route::get('/home', [HomeController::class, 'index'])->name('home');
