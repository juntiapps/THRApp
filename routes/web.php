<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\SocialiteController; // Pastikan Anda membuat controller ini
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\Master\MasterEwalletController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Models\Project;
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
    Route::resource('users', UserController::class)->only(['index', 'destroy']);
    Route::resource('projects', ProjectController::class)->only(['index', 'destroy', 'show']);
    Route::group(['prefix' => 'master'], function () {
        Route::resource('ewallet', MasterEwalletController::class)->except(['show', 'delete']);
    });
});

//user flow
Route::group(['middleware' => ['auth', 'user',], 'prefix' => 'user'], function () {
    Route::get('/home', [UserDashboard::class, 'index'])->name('user_home');
    Route::group(['prefix' => 'projects'], function () {
        Route::get('create', [UserDashboard::class, 'create'])->name('u.projects.create');
        Route::post('', [UserDashboard::class, 'store'])->name('u.projects.store');
        Route::get('{project}/edit', [UserDashboard::class, 'edit'])->name('u.projects.edit');
        Route::get('{project}', [UserDashboard::class, 'show'])->name('u.projects.show');
        // Route::put('update', [UserDashboard::class, 'update'])->name('u.projects.update');
        Route::put('{project}', [UserDashboard::class, 'update'])->name('u.projects.update');
        Route::delete('{project}', [UserDashboard::class, 'destroy'])->name('u.projects.destroy');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/project/{id}', [HomeController::class, 'show'])->name('show_project');
