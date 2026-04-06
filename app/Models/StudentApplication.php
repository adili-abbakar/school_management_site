<?php

namespace App\Models;

use App\Models\Academic\Session;
use Illuminate\Database\Eloquent\Model;

class StudentApplication extends Model
{

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
        'session_id',
        'status',
    ];


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
}
