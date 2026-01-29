<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Session extends Model
{
    protected $table = 'academic_sessions';
    protected $fillable = [
        'name',
        'start_date',
        'end_date'
    ];


    public function terms(): HasMany
    {
        return $this->hasMany(Term::class, 'session_id');
    }
}
