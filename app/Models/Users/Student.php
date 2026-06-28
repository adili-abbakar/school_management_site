<?php

namespace App\Models\Users;

use App\Models\Academic\StudentProgramEnrollment;
use App\Models\NumberingSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'admission_number',
        'current_status',
        'admission_date',
        'graduation_date',
        'guardian_user_id',
        'guardian_relationship'
    ];

    protected $casts = [
        'admission_date' => 'datetime',
        'graduation_date' => 'datetime'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'guardian_user_id', 'user_id');
    }


    public static function generateAdmissionNumber()
    {
        try {
            return NumberingSetting::generateUnique(
                'admission_number',
                Student::class,
                'admission_number'
            );
        } catch (\Throwable $e) {
            // fallback old method
            $year = now()->year;

            $last = self::whereYear('created_at', $year)
                ->orderByDesc('admission_number')
                ->value('admission_number');

            $number = $last ? ((int) substr($last, -3) + 1) : 1;

            return 'ADM/' . $year . '/' . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
    }

    public function programEnrollments()
    {
        return $this->hasMany(StudentProgramEnrollment::class, 'student_id', 'user_id');
    }

    public function activeProgramEnrollments()
    {
        return $this->programEnrollments()
            ->where('status', 'active');
    }

    public function isEnrolledIn(int $programId): bool
    {
        return $this->programEnrollments()
            ->where('program_id', $programId)
            ->where('status', 'active')
            ->exists();
    }
}
