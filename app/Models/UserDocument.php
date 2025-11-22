<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    protected $table = 'user_documents';
    protected $primaryKey = 'document_id';
    protected $fillable = [
        'user_id', 'brgyCert', 'birthCert', 'gradeReport', 'idPicture', 'cor', 'votersCert'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
