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
Route::get('/mem_dashboard', function () {
    return redirect()->route('sections.activities');
    })->name('mem_dashboard')->middleware(['auth', 'role:member']);

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
Route::get('/faci_dashboard', function () {
    return redirect()->route('sections.activities_feed');
    })->name('faci_dashboard')->middleware(['auth', 'role:facilitator']);

Route::post('/faci_dashboard/activity', [FacilitatorController::class, 'storeActivity'])
    ->name('faci.activity.store')
    ->middleware(['auth', 'role:facilitator']);

Route::post('/faci_dashboard/attendance/{activity_id}', [FacilitatorController::class, 'updateAttendance'])
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
});
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
    Route::delete('/activity/{id}/delete', [FacilitatorController::class, 'destroyActivity'])->name('faci.activity.delete');

    // Attendance (Members)
    Route::get('/members', [FacilitatorController::class, 'faci_members'])->name('faci.members');

    // Sponsors
    Route::get('/sponsors', [FacilitatorController::class, 'faci_sponsors'])->name('faci.sponsors');

    // Profile
    Route::get('/profile', [FacilitatorController::class, 'faci_profile'])->name('facilitator.profile');
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
    Route::get('/faci_dashboard/activities-feed', [FacilitatorController::class, 'faci_activities_feed'])->name('sections.activities_feed');
    Route::get('/profile', [FacilitatorController::class, 'faci_profile'])->name('sections.faci_profile');
    Route::get('/members', [App\Http\Controllers\FacilitatorController::class, 'faci_members'])->name('sections.member');
    Route::get('/sponsors', [App\Http\Controllers\FacilitatorController::class, 'faci_sponsors'])->name('sections.sponsors');
    Route::get('/reports', [App\Http\Controllers\FacilitatorController::class, 'faci_reports'])->name('sections.reports');
});

// ------------------------------ 
// Admin Dashboard Subpages
// ------------------------------
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('sections.dashboard');
    Route::get('/user_manage', [AdminController::class, 'user_manage'])->name('sections.user_manage');
    Route::get('/profile', [AdminController::class, 'profile'])->name('sections.admin_profile');
});

// ------------------------------
// Report Download PDF
// ------------------------------


Route::get('/download-pdf', [ReportController::class, 'downloadPDF'])->name('download.pdf');

Route::get('/system-log', [SystemLogController::class, 'index'])->name('system_log');


Route::get('/send-test', function () {
    try {
        Mail::raw('This is a test email from Laravel using Gmail SMTP.', function ($message) {
            $message->to('yourtestemail@gmail.com') // change to your recipient email
                    ->subject('Laravel Email Test');
        });

        return '✅ Email sent successfully!';
    } catch (\Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
});