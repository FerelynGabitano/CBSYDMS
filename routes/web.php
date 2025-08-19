<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FacilitatorController;
use App\Http\Controllers\LearnMoreController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;



Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/register', [RegisterController::class, 'create'])->name('register');  
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/learnmore', [LearnMoreController::class, 'learnmore'])->name('learnmore');
Route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard'); 
Route::get('/mem_dashboard', [MemberController::class, 'mem_dashboard'])->name('mem_dashboard')->middleware('auth');
Route::get('/faci_dashboard', [FacilitatorController::class, 'faci_dashboard'])->name('faci_dashboard');
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.details')->where('id', '[1-5]');