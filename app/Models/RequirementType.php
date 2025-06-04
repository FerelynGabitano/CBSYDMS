<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RequirementType extends Model
{
    protected $primaryKey = 'requirement_id';

    public function userRequirements(): HasMany
    {
        return $this->hasMany(UserRequirement::class, 'requirement_id');
    }
}