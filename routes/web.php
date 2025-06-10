<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LearnMoreController;
use App\Http\Controllers\AuthController;

Route::get('/welcome', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/learnmore', [LearnMoreController::class, 'learnmore'])->name('learnmore');
Route::get('/admin_dashboard', [WelcomeController::class, 'admin_dashboard'])->name('admin_dashboard'); // Placeholder
Route::get('/mem_dashboard', [WelcomeController::class, 'mem_dashboard'])->name('mem_dashboard'); // Placeholder
Route::get('/faci_dashboard', [WelcomeController::class, 'faci_dashboard'])->name('faci_dashboard'); // Placeholder
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.details')->where('id', '[1-5]');