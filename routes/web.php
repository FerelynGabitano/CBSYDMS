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
use App\Http\Controllers\SystemLogController;
use Illuminate\Support\Facades\Mail;

// ------------------------------
// Public Routes (Guests Only)
// ------------------------------
Route::middleware('guest.redirect')->group(function () {
    Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/learnmore', [LearnMoreController::class, 'learnmore'])->name('learnmore');
});

// ------------------------------
// Logout (Auth Required)
// ------------------------------
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ------------------------------
// Admin Dashboard
// ------------------------------
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('sections.dashboard');
    Route::get('/user_manage', [AdminController::class, 'user_manage'])->name('sections.user_manage');
    Route::get('/profile', [AdminController::class, 'profile'])->name('sections.admin_profile');
    Route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');
});

// ------------------------------
// Member Dashboard
// ------------------------------
Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('/mem_dashboard', fn() => redirect()->route('sections.activities'))->name('mem_dashboard');

    Route::prefix('member')->group(function () {
        Route::get('/activities', [MemberController::class, 'activities'])->name('sections.activities');
        Route::get('/profile', [MemberController::class, 'profile'])->name('sections.profile');
        Route::get('/participation', [MemberController::class, 'participation'])->name('sections.participation');
        Route::get('/gallery', [MemberController::class, 'gallery'])->name('sections.gallery');
        Route::get('/scholarships', [MemberController::class, 'scholarships'])->name('sections.scholarships');
    });

    Route::post('/activities/join/{activity}', [MemberController::class, 'joinActivity'])->name('activities.join');
    Route::post('/scholarship/upload', [MemberController::class, 'uploadScholarshipRequirements'])->name('upload.scholarship');
    Route::post('/profile/update-picture', [MemberController::class, 'updateProfilePicture'])->name('profile.picture.update');
    Route::put('/profile/update', [MemberController::class, 'updateProfile'])->name('profile.update');
});

// ------------------------------
// Facilitator Dashboard
// ------------------------------
Route::middleware(['auth', 'role:facilitator'])->group(function () {
    Route::get('/faci_dashboard', fn() => redirect()->route('sections.activities_feed'))->name('faci_dashboard');

    Route::prefix('facilitator')->group(function () {
        // Dashboard
        Route::get('/dashboard', [FacilitatorController::class, 'faci_dashboard'])->name('faci.dashboard');
        Route::get('/faci_dashboard/activities-feed', [FacilitatorController::class, 'faci_activities_feed'])->name('sections.activities_feed');

        // Profile
        Route::get('/profile', [FacilitatorController::class, 'faci_profile'])->name('sections.faci_profile');
        Route::put('/profile/update', [FacilitatorController::class, 'updateProfile'])->name('faci.profile.update');
        Route::post('/profile/picture', [FacilitatorController::class, 'updateProfilePicture'])->name('faci.profile.picture');

        // Activities
        Route::post('/activity', [FacilitatorController::class, 'storeActivity'])->name('faci.activity.store');
        Route::put('/activity/{activity_id}', [FacilitatorController::class, 'updateActivity'])->name('faci.activity.update');
        Route::delete('/activity/{activity_id}', [FacilitatorController::class, 'destroyActivity'])->name('faci.activity.destroy');

        // Attendance
        Route::post('/attendance/{activity_id}', [FacilitatorController::class, 'updateAttendance'])->name('faci.attendance.update');

        // Sponsors
        Route::get('/sponsors', [FacilitatorController::class, 'faci_sponsors'])->name('faci.sponsor.index');
        Route::post('/sponsor/store', [FacilitatorController::class, 'storeSponsor'])->name('faci.sponsor.store');
        Route::put('/sponsor/{id}', [FacilitatorController::class, 'updateSponsor'])->name('faci.sponsor.update');
        Route::delete('/sponsor/{id}', [FacilitatorController::class, 'destroySponsor'])->name('faci.sponsor.destroy');
        
        // Members
        Route::get('/members', [FacilitatorController::class, 'faci_members'])->name('sections.member');

        // Reports
        Route::get('/reports', [FacilitatorController::class, 'faci_reports'])->name('sections.reports');
        Route::post('/reports/filter', [FacilitatorController::class, 'filterReports'])->name('facilitator.reports.filter');
        Route::get('/reports/download', [FacilitatorController::class, 'downloadReport'])->name('facilitator.reports.download');

        // ✅ Individual Activity Reports
        Route::get('/reports/{id}/preview', [FacilitatorController::class, 'previewActivityReport'])->name('facilitator.reports.preview');
        Route::get('/reports/{id}/download', [FacilitatorController::class, 'downloadActivityReport'])->name('facilitator.reports.download.single');
    });
});

// ------------------------------
// Projects (Public)
// ------------------------------
Route::get('/project/{id}', [ProjectController::class, 'show'])
    ->name('project.details')
    ->where('id', '[1-5]');

// ------------------------------
// User Management
// ------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/users/{user_id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user_id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user_id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// ------------------------------
// Reports Controller (General)
// ------------------------------
Route::get('/download-pdf', [ReportController::class, 'downloadPDF'])->name('download.pdf');

// ------------------------------
// System Logs
// ------------------------------
Route::get('/system-log', [SystemLogController::class, 'index'])->name('system_log');

// ------------------------------
// Test Email (Debug)
// ------------------------------
Route::get('/send-test', function () {
    try {
        Mail::raw('This is a test email from Laravel using Gmail SMTP.', function ($message) {
            $message->to('yourtestemail@gmail.com')
                ->subject('Laravel Email Test');
        });
        return '✅ Email sent successfully!';
    } catch (\Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
});
