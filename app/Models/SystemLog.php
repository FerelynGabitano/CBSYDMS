<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemLog extends Model
{
    protected $primaryKey = 'log_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}