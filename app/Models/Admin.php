<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staff_number',
        'role_type',
        'highest_qualification',
        'years_of_experience',
        'start_date',
        'employment_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
