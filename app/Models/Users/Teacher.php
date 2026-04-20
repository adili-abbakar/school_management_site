<?php

namespace App\Models\Users;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'staff_number', 'specialized_subject', 'highest_qualification', 'years_of_experience', 'start_date', 'employment_type'];

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
        ];
    }


    public function startDate()
    {
        return $this->start_date ? $this->start_date->translatedFormat('l, jS F, Y') : 'Not Set';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function arms()
    {
        return $this->hasMany(ClassArm::class, 'teacher_id');
    }

    public function name()
    {
        if ($this->user && $this->user->gender === 'male') {
            return "Mr. " . $this->user->full_name;
        }
        return "Mrs. " . $this->user?->full_name;
    }
}
