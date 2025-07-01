<?php

use App\Http\Controllers\AcademicYear;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::get('/', [HomeController::class, 'home'])->name('home');
  Route::get('/about', [HomeController::class, 'about'])->name('about');
  Route::get('/register', [RegisterController::class, 'register'])->name('register');
  Route::post('/register', [RegisterController::class, 'store']);
  Route::get('/login', [AuthController::class, 'login'])->name('login');
  Route::post('/login', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

  Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
  Route::post('/profile', [HomeController::class, 'profileUpload']);
  Route::delete('/profile', [HomeController::class, 'profileDestroy']);

  Route::get('/acacdemic-year', [AcademicYear::class, 'index'])->name('acacdemic_year');
  Route::post('/acacdemic-year', [AcademicYear::class, 'store']);
  Route::delete('/acacdemic-year/{id}', [AcademicYear::class, 'destroy'])->name('destroy');

  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
