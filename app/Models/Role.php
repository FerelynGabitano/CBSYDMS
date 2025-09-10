<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $primaryKey = 'role_id'; // your PK
    public $timestamps = false; // if your roles table doesn’t have created_at/updated_at

    protected $fillable = ['role_name']; // adjust to match your column names

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
