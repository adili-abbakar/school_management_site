<?php

namespace App\Models\Academic;

use App\Models\Users\Student;
use App\Models\Users\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassArm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'teacher_id',
        'class_id',
        'is_active',
        'capacity'
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function studentSessionRecords(): HasMany
    {
        return $this->hasMany(StudentSessionRecord::class, 'class_arm_id', 'id');
    }

    public function getCurrentSessionStudentsAttribute()
    {
        $currentSession = Session::currentSession();

        if (!$currentSession) {
            return collect();
        }

        return $this->studentSessionRecords()
            ->where('session_id', $currentSession->id)
            ->get();
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function getFullNameAttribute(): string
    {
        return $this->class->name . ' ' . $this->name;
    }



    public static function resolveClassArmForApplicationProgram($approvedClassId): ?self
    {
        $class = AcademicClass::find($approvedClassId);

        if (!$class) {
            return null;
        }

        $currentSession = Session::currentSession();

        if (!$currentSession) {
            return null;
        }

        $arms = $class->arms()->get();

        if ($arms->isEmpty()) {
            return null;
        }

        foreach ($arms as $arm) {
            $arm->student_count = $arm->studentSessionRecords()
                ->where('session_id', $currentSession->id)
                ->count();

            if ($arm->student_count < 30) {
                return $arm;
            }
        }

        $lowestCount = $arms->min('student_count');

        return $arms->where('student_count', $lowestCount)
            ->values()
            ->random();
    }
}
