<?php

namespace App\Models;

use App\Models\Academic\AcademicClass;
use App\Models\Academic\Program;
use Illuminate\Database\Eloquent\Model;

class ApplicationProgram extends Model
{
    protected $fillable = [
        'application_id',
        'program_id',
        'requested_class_id',
        'approved_class_id',
        'status'
    ];

    public function application()
    {
        return $this->belongsTo(StudentApplication::class);
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
