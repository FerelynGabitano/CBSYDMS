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
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/learnmore', [LearnMoreController::class, 'learnmore'])->name('learnmore');

Route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard')->middleware('auth');
Route::get('/mem_dashboard', [MemberController::class, 'mem_dashboard'])->name('mem_dashboard')->middleware('auth');

Route::get('/faci_dashboard', [FacilitatorController::class, 'faci_dashboard'])->name('faci_dashboard')->middleware('auth');

Route::post('/faci_dashboard/activity', [FacilitatorController::class, 'storeActivity'])->name('faci.activity.store')->middleware('auth');

Route::post('/faci_dashboard/attendance', [FacilitatorController::class, 'updateAttendance'])->name('faci.attendance.update')->middleware('auth');

Route::post('/faci_dashboard/sponsor', [FacilitatorController::class, 'storeSponsor'])->name('faci.sponsor.store')->middleware('auth');
    
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.details')->where('id', '[1-5]');
    
    
