<?php

namespace App\Models\Users;

use App\Models\Academic\ClassArm;
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
        'current_class_arm_id',
        'current_status',
        'admission_date',
        'graduation_date',
        'guardian_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function currentClassArm()
    {
        return $this->belongsTo(ClassArm::class, 'current_class_arm_id', 'id');
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'guardian_id', 'user_id');
    }

    public static function generateAdmissionNumber()
    {
        $year = now()->year;

        $last = self::whereYear('created_at', $year)
            ->orderByDesc('admission_number')
            ->value('admission_number');

        if (!$last) {
            $number = 1;
        } else {
            $number = (int) substr($last, -4) + 1;
        }

        return 'ADM/' . $year . '/' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
