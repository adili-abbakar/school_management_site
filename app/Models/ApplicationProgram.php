<?php

namespace App\Models;

use App\Models\Academic\AcademicClass;
use App\Models\Academic\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationProgram extends Model
{
    protected $fillable = [
        'student_application_id',
        'program_id',
        'requested_class_id',
        'approved_class_id',
        'status',
        'remarks'
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(
            StudentApplication::class,
            'student_application_id'
        );
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function requestedClass()
    {
        return $this->belongsTo(AcademicClass::class, 'requested_class_id');
    }

    public function approvedClass()
    {
        return $this->belongsTo(AcademicClass::class, 'approved_class_id');
    }
}
