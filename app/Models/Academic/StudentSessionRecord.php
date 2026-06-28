<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentSessionRecord extends Model
{
    protected $fillable = [
        'student_program_enrollment_id',
        'session_id',
        'class_id',
        'class_arm_id',
        'status',
        'started_at',
        'completed_at',
        'remarks',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(StudentProgramEnrollment::class, 'student_program_enrollment_id');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function classArm(): BelongsTo
    {
        return $this->belongsTo(ClassArm::class);
    }

    public function termRecords(): HasMany
    {
        return $this->hasMany(StudentTermRecord::class);
    }
}
