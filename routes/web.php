<?php

use App\Http\Controllers\AcademicYear;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MajorController;
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

  /* These routes are related to user profile */
  Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
  Route::post('/profile', [HomeController::class, 'profileUpload']);
  Route::delete('/profile', [HomeController::class, 'profileDestroy']);

  Route::prefix('academic')->group(function () {
    /* These routes are related to major */
    Route::get('/major', [MajorController::class, 'index'])->name('major');
    Route::post('/major', [MajorController::class, 'store'])->name('major.store');
    Route::post('/import-major', [MajorController::class, 'import'])->name('major.import');
    Route::get('/major/detail/{text_id}', [MajorController::class, 'detail'])->name('major.detail');

    Route::get('/year', [AcademicYear::class, 'index'])->name('academic_year');
    Route::post('/year', [AcademicYear::class, 'store']);
    Route::delete('/year/{id}', [AcademicYear::class, 'destroy'])->name('destroy');
  });



  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
