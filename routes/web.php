<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LearnMoreController;
use App\Http\Controllers\AuthController;

Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::get('/learnmore', [LearnMoreController::class, 'index'])->name('learnmore');
Route::get('/admin_dashboard', [WelcomeController::class, 'index'])->name('admin_dashboard'); // Placeholder
Route::get('/mem_dashboard', [WelcomeController::class, 'index'])->name('mem_dashboard'); // Placeholder
Route::get('/faci_dashboard', [WelcomeController::class, 'index'])->name('faci_dashboard'); // Placeholder
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.details')->where('id', '[1-5]');