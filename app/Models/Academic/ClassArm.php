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
        'class_id'
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'current_class_arm_id', 'id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function getFullNameAttribute(): string
    {
        return $this->class->name . ' ' . $this->name;
    }

    public static function resolveTargetClass($application): ?AcademicClass
    {
        if (!empty($application->class_id)) {
            return AcademicClass::find($application->class_id);
        }

        if (!empty($application->class_name)) {
            return AcademicClass::where('name', $application->class_name)->first();
        }

        return null;
    }

    public static function resolveClassArmForApplication($application): ?self
    {
        $class = self::resolveTargetClass($application);

        if (!$class) {
            return null;
        }

        $arms = $class->arms()
            ->withCount([
                'students as active_students_count' => function ($q) {
                    $q->where('current_status', 'active');
                }
            ])
            ->get();

        if ($arms->isEmpty()) {
            return null;
        }

        $stream = trim((string) ($application->stream ?? ''));

        if ($stream !== '') {
            $matchedArm = $arms->first(function ($arm) use ($stream) {
                return strcasecmp(trim($arm->name), trim($stream)) === 0;
            });

            if ($matchedArm) {
                return $matchedArm;
            }
        }

        $lowestCount = $arms->min('active_students_count');

        return $arms->where('active_students_count', $lowestCount)
            ->values()
            ->random();
    }
}
