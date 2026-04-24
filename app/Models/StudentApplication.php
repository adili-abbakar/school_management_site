<?php

namespace App\Models;

use App\Models\Academic\AcademicClass;
use App\Models\Academic\Session;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentApplication extends Model
{
    use SoftDeletes;
    protected $fillable =  [
        'student_first_name',
        'student_middle_name',
        'student_last_name',
        'student_date_of_birth',
        'student_gender',
        'student_nationality',
        'student_state',
        'student_local_government',
        'student_religion',
        'student_tribe',
        'student_address',

        'guardian_first_name',
        'guardian_middle_name',
        'guardian_last_name',
        'guardian_phone',
        'guardian_email',
        'guardian_date_of_birth',
        'guardian_gender',
        'guardian_nationality',
        'guardian_state',
        'guardian_local_government',
        'guardian_religion',
        'guardian_tribe',
        'guardian_address',
        'guardian_occupation',
        'guardian_relationship',
        'previous_school_name',
        'last_class_attended',
        'class_id',

        'application_number',
        'previous_school_name',
        'last_class_attended',
        'class_id',
        'stream',
        'session_id',
        'status',
        'submitted_by_user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'guardian_date_of_birth' => 'datetime',
        'student_date_of_birth' => 'datetime'
    ];
    public function getStudentNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->student_first_name,
            $this->student_middle_name,
            $this->student_last_name,
        ])));
    }

    public function getGuardianNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->guardian_first_name,
            $this->guardian_middle_name,
            $this->guardian_last_name,
        ])));
    }

    public static function generateApplicationNumber($sessionId)
    {
        $session = Session::findOrFail($sessionId);

        $sessionName = str_replace('/', '-', $session->name);

        $last = StudentApplication::where('session_id', $sessionId)
            ->latest('id')
            ->first();

        if ($last && preg_match('/(\d+)$/', $last->application_number, $matches)) {
            $nextNumber = (int)$matches[1] + 1;
        } else {
            $nextNumber = 1;
        }

        $number = str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        return "APP-{$sessionName}-{$number}";
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function getExpectedDecisionAttribute()
    {
        return $this->created_at->copy()->addDays(7)->diffForHumans() . ' (' . $this->created_at->copy()->addDays(7)->format("d M, Y") . ')';
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_user_id');
    }

    public function getApplicantCategoryAttribute(): string
    {
        if (!$this->submitted_by_user_id) {
            return 'new_applicant';
        }

        if ($this->submittedBy && $this->submittedBy->isStaff()) {
            return 'staff';
        }

        return 'Existing_guardian';
    }
}
