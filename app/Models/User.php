<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'contact_number',
        'credential_email',
        'email',
        'password',
        'street_address',
        'barangay',
        'city_municipality',
        'province',
        'zip_code',
        'profile_picture',
        'role_id',
        'is_active',
        'course',
        'skills',
        'brgyCert',
        'birthCert',
        'gradeReport',
        'idPicture',
        'school',      
        'gradeLevel',             
        'emergency_contact_no',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** ============================
     *        RELATIONSHIPS
     *  ============================ */

    // User role relationship
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    // User uploaded requirements
    public function requirements(): HasMany
    {
        return $this->hasMany(UserRequirement::class, 'user_id');
    }

    // Reviewed requirements
    public function reviewedRequirements(): HasMany
    {
        return $this->hasMany(UserRequirement::class, 'reviewed_by');
    }

    // ✅ FIXED: Correct belongsToMany relationship with activities
    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(
            Activity::class,         
            'activity_participants', 
            'user_id',               
            'activity_id'           
        )
        ->withPivot('attendance_status')
        ->withTimestamps();
    }

    // Activities created by the user
    public function createdActivities(): HasMany
    {
        return $this->hasMany(Activity::class, 'created_by');
    }

    // Attendance logs
    public function attendanceLogs(): HasMany
    {
        return $this->hasMany(AttendanceLog::class, 'user_id');
    }

    // Contributions recorded by the user
    public function recordedContributions(): HasMany
    {
        return $this->hasMany(SponsorContribution::class, 'recorded_by');
    }
}
