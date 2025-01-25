<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\SocialiteController; // Pastikan Anda membuat controller ini
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
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
Route::group(['middleware' => ['auth', 'admin'],'prefix'=>'admin'], function () {
    Route::get('/home', [AdminDashboard::class, 'index'])->name('admin_home');
});

//user flow
Route::group(['middleware' => ['auth', 'user',], 'prefix'=>'user'], function () {
    Route::get('/home', [UserDashboard::class, 'index'])->name('user_home');
    // Route::post('/dashboard', [UserDashboard::class, 'create'])->name('url.shorten.user');
    // Route::post('/dashboard/edit/{id}', [UserDashboard::class, 'update'])->name('update.user');
    // Route::post('/dashboard/deactivate/{id}', [UserDashboard::class, 'deactivate'])->name('deactivate.user');
    // Route::post('/dashboard/activate/{id}', [UserDashboard::class, 'activate'])->name('activate.user');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
