<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    use HasFactory;

    protected $table = 'system_logs';
    protected $primaryKey = 'log_id';
    protected $fillable = ['user_id', 'action', 'details', 'ip_address'];

    // ✅ Relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
