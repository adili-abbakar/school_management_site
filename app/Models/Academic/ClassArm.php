<?php

namespace App\Models\Academic;

use App\Models\Users\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassArm extends Model
{
    /** @use HasFactory<\Database\Factories\Academic\ClassArmFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'teacher_id',
        'class_id'
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
