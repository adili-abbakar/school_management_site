<?php

namespace App\Models\Academic;

use App\Models\ApplicationProgram;
use App\Models\Users\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentProgramEnrollment extends Model
{
    protected $fillable = [
        'student_id',
        'program_id',
        'application_program_id',
        'admission_date',
        'status',
        'remarks',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function applicationProgram(): BelongsTo
    {
        return $this->belongsTo(ApplicationProgram::class);
    }

    public function sessionRecords(): HasMany
    {
        return $this->hasMany(StudentSessionRecord::class);
    }
}
