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

    // Public routes
    Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');  
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

    Route::get('/learnmore', [LearnMoreController::class, 'learnmore'])->name('learnmore');

    // Admin dashboard (only admins can access)
    Route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard'])
        ->name('admin_dashboard')
        ->middleware(['auth', 'role:admin']);

    // Member dashboard (only members can access)
    Route::get('/mem_dashboard', [MemberController::class, 'mem_dashboard'])
        ->name('mem_dashboard')
        ->middleware(['auth', 'role:member']);

    // Facilitator dashboard (only facilitators can access)
    Route::get('/faci_dashboard', [FacilitatorController::class, 'faci_dashboard'])
        ->name('faci_dashboard')
        ->middleware(['auth', 'role:facilitator']);

    // Facilitator-only actions
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
        ->middleware(['auth','role:facilitator']);

    Route::delete('/faci_dashboard/activity/{activity_id}', [FacilitatorController::class, 'destroyActivity'])
        ->name('faci.activity.destroy')
        ->middleware(['auth','role:facilitator']);


    // Projects (still public but limited to IDs 1-5)
    Route::get('/project/{id}', [ProjectController::class, 'show'])
        ->name('project.details')
        ->where('id', '[1-5]');

    // Users resource (all user management requires auth)
    Route::resource('users', UserController::class)->middleware('auth');

    // Specific user management actions
    Route::middleware('auth')->group(function () {
        Route::get('/users/{user_id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user_id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user_id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
