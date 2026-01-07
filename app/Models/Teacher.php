<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'staff_number', 'specialized_subject', 'highest_qualification', 'years_of_experience', 'start_date', 'employment_type'];

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'int';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
