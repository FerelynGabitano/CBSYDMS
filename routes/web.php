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
use App\Http\Controllers\UserController; 
use App\Http\Controllers\ReportController;
// ------------------------------
// Public routes (for guests only)
// ------------------------------
Route::middleware('guest.redirect')->group(function () {
    Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/learnmore', [LearnMoreController::class, 'learnmore'])->name('learnmore');
});

// Logout (only for logged-in users)
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ------------------------------
// Admin dashboard
// ------------------------------
Route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard'])
    ->name('admin_dashboard')
    ->middleware(['auth', 'role:admin']);

// ------------------------------
// Member dashboard
// ------------------------------
Route::get('/mem_dashboard', [MemberController::class, 'mem_dashboard'])
    ->name('mem_dashboard')
    ->middleware(['auth', 'role:member']);

Route::post('/activities/join/{activity}', [MemberController::class, 'joinActivity'])
    ->name('activities.join')
    ->middleware(['auth', 'role:member']);

Route::post('/scholarship/upload', [MemberController::class, 'uploadScholarshipRequirements'])
    ->name('upload.scholarship');

Route::post('/profile/update-picture', [MemberController::class, 'updateProfilePicture'])
    ->name('profile.picture.update');

Route::put('/profile/update', [MemberController::class, 'updateProfile'])
    ->name('profile.update');

// ------------------------------
// Facilitator dashboard
// ------------------------------
Route::get('/faci_dashboard', [FacilitatorController::class, 'faci_dashboard'])
    ->name('faci_dashboard')
    ->middleware(['auth', 'role:facilitator']);

Route::post('/faci_dashboard/activity', [FacilitatorController::class, 'storeActivity'])
    ->name('faci.activity.store')
    ->middleware(['auth', 'role:facilitator']);

Route::post('/faci_dashboard/attendance', [FacilitatorController::class, 'updateAttendance'])
    ->name('faci.attendance.update')
    ->middleware(['auth', 'role:facilitator']);

Route::post('/faci_dashboard/sponsor', [FacilitatorController::class, 'storeSponsor'])
    ->name('faci.sponsor.store')
    ->middleware(['auth', 'role:facilitator']);

Route::put('/faci_dashboard/activity/{activity_id}', [FacilitatorController::class, 'updateActivity'])
    ->name('faci.activity.update')
    ->middleware(['auth', 'role:facilitator']);

Route::delete('/faci_dashboard/activity/{activity_id}', [FacilitatorController::class, 'destroyActivity'])
    ->name('faci.activity.destroy')
    ->middleware(['auth', 'role:facilitator']);

Route::get('/facilitator/reports', [FacilitatorController::class, 'filterReports'])
    ->name('facilitator.reports.filter');

Route::get('/facilitator/reports/pdf', [FacilitatorController::class, 'generatePDF'])
    ->name('facilitator.reports.pdf');

// Projects (still public)// 
Route::get('/project/{id}', [ProjectController::class, 'show'])
    ->name('project.details')
    ->where('id', '[1-5]');
    
Route::put('/faci_dashboard/profile/update', [FacilitatorController::class, 'updateProfile'])
    ->name('faci.profile.update')
    ->middleware(['auth', 'role:facilitator']);
// ------------------------------
// User management (auth only)
// ------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/users/{user_id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user_id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user_id}', [UserController::class, 'destroy'])->name('users.destroy');

// ------------------------------ 
// Member Dashboard Subpages
// ------------------------------
Route::prefix('member')->middleware(['auth', 'role:member'])->group(function () {
    Route::get('/activities', [MemberController::class, 'activities'])->name('sections.activities');
    Route::get('/profile', [MemberController::class, 'profile'])->name('sections.profile');
    Route::get('/participation', [MemberController::class, 'participation'])->name('sections.participation');
    Route::get('/gallery', [MemberController::class, 'gallery'])->name('sections.gallery');
    Route::get('/scholarships', [MemberController::class, 'scholarships'])->name('sections.scholarships');
});

// ------------------------------ 
// Facilitator Dashboard Subpages
// ------------------------------
Route::prefix('facilitator')->middleware(['auth', 'role:facilitator'])->group(function () {
    // Dashboard / Activities
    Route::get('/dashboard', [FacilitatorController::class, 'faci_dashboard'])->name('faci.dashboard');
    Route::post('/activity/store', [FacilitatorController::class, 'storeActivity'])->name('faci.activity.store');
    Route::post('/activity/{id}/update', [FacilitatorController::class, 'updateActivity'])->name('faci.activity.update');
    Route::delete('/activity/{id}/delete', [FacilitatorController::class, 'destroyActivity'])->name('faci.activity.delete');

    // Attendance (Members)
    Route::post('/attendance/update', [FacilitatorController::class, 'updateAttendance'])->name('faci.attendance.update');
    Route::get('/members', [FacilitatorController::class, 'faci_members'])->name('faci.members');

    // Sponsors
    Route::get('/sponsors', [FacilitatorController::class, 'faci_sponsors'])->name('faci.sponsors');
    Route::post('/sponsor/store', [FacilitatorController::class, 'storeSponsor'])->name('faci.sponsor.store');

    // Profile
    Route::get('/profile', [FacilitatorController::class, 'faci_profile'])->name('facilitator.profile');
    Route::post('/profile/update', [FacilitatorController::class, 'updateProfile'])->name('faci.profile.update');
    Route::post('/profile/picture', [FacilitatorController::class, 'updateProfilePicture'])->name('faci.profile.picture');

    // Reports / PDF
    Route::get('/reports', [FacilitatorController::class, 'faci_reports'])->name('faci.reports');
    Route::get('/reports/filter', [FacilitatorController::class, 'filterReports'])->name('facilitator.reports.filter');
    Route::get('/reports/download', [FacilitatorController::class, 'downloadReport'])->name('facilitator.reports.download');
});

// ------------------------------
// Match Blade "sections.*" routes
// ------------------------------
Route::prefix('facilitator')->middleware(['auth', 'role:facilitator'])->group(function () {
    Route::get('/activities-feed', [App\Http\Controllers\FacilitatorController::class, 'faci_dashboard'])->name('sections.activities_feed');
    Route::get('/profile', [FacilitatorController::class, 'faci_profile'])->name('sections.faci_profile');
    Route::get('/members', [App\Http\Controllers\FacilitatorController::class, 'faci_members'])->name('sections.member');
    Route::get('/sponsors', [App\Http\Controllers\FacilitatorController::class, 'faci_sponsors'])->name('sections.sponsors');
    Route::get('/reports', [App\Http\Controllers\FacilitatorController::class, 'faci_reports'])->name('sections.reports');
});
// ------------------------------
// Report Download PDF
// ------------------------------


Route::get('/download-pdf', [ReportController::class, 'downloadPDF'])->name('download.pdf');

});
