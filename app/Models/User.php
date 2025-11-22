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
        'profile_picture',
        'role_id',
        'is_active',
        'course',
        'skills',
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

    // Activities user participates in
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activity_participants', 'user_id', 'activity_id')
            ->using(\App\Models\ActivityParticipant::class)
            ->withPivot('participant_id', 'attendance_status')
            ->withTimestamps();
    }

    // Activities created by the user
    public function createdActivities(): HasMany
    {
        return $this->hasMany(Activity::class, 'created_by');
    }

    // ✅ New: User address relationship
    public function address()
    {
        return $this->hasOne(UserAddress::class, 'user_id', 'user_id');
    }

    // ✅ New: User documents relationship
    public function documents()
    {
        return $this->hasOne(UserDocument::class, 'user_id', 'user_id');
    }
}
