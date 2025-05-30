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



Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.details');