<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/learnmore', function () {
    return view('learnmore');
})->name('learnmore');

Route::get('/admin_dashboard', function () {
    return view('admin_dashboard');
})->name('admin_dashboard');

Route::get('/mem_dashboard', function () {
    return view('mem_dashboard');
})->name('mem_dashboard');

Route::get('/faci_dashboard', function () {
    return view('faci_dashboard');
})->name('faci_dashboard');

Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.details');