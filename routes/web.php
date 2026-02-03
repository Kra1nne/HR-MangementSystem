<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\pages\MiscTooManyRequest;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\homepage\HomePagesController;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;

Route::get('/', [HomePagesController::class, 'home'])->name('home-page');
Route::get('/about', [HomePagesController::class, 'about'])->name('about-page');
Route::get('/services', [HomePagesController::class, 'services'])->name('services-page');
Route::get('/contact', [HomePagesController::class, 'contact'])->name('contact-page');

Route::middleware(['guest', 'throttle:web'])->group(function () {
  Route::get('/register', [RegisterBasic::class, 'index'])->name('auth-register');
  Route::post('/register/add', [RegisterBasic::class, 'store'])->name('auth-register-add');

  Route::get('/login', [LoginBasic::class, 'index'])->name('login');
  Route::post('/login/process', [LoginBasic::class, 'login'])->name('login-process')->middleware(['throttle:login']);

  Route::get('/forgot-password', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password');
});

Route::middleware(['auth', 'role:Admin,Employee', 'throttle:web'])->group(function () {
  Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');

  Route::get('/user', [UserController::class, 'index'])->name('user-accounts');
  Route::post('/user/add', [UserController::class, 'store'])->name('user-add');
  Route::post('/user/update', [UserController::class, 'update'])->name('user-update');
  Route::post('/user/delete', [UserController::class, 'delete'])->name('user-delete');

  Route::middleware(['role:Admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user-accounts');
    Route::post('/user/add', [UserController::class, 'store'])->name('user-add');
    Route::post('/user/update', [UserController::class, 'update'])->name('user-update');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('user-delete');
  });

  Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
});

Route::get('/logout', [LoginBasic::class, 'logoutAccount'])->name('logout-process')->middleware(['throttle:web']);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');
Route::get('/pages/misc-too-many-request', [MiscTooManyRequest::class, 'index'])->name('pages-misc-too-many-request');
