<?php

namespace App\Models\Users;

use App\Models\NumberingSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'staff';

    protected $fillable = [
        'user_id',
        'staff_number',
        'staff_type',
        'employment_date',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class, 'staff_id');
    }

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'staff_id');
    }

    public static function generateStaffNumber(): string
    {
        try {
            return NumberingSetting::generateUnique(
                'staff_number',
                self::class,
                'staff_number'
            );
        } catch (\Throwable $e) {
            $year = now()->year;

            $last = self::whereYear('created_at', $year)
                ->orderByDesc('staff_number')
                ->value('staff_number');

            $number = $last ? ((int) substr($last, -3) + 1) : 1;

            return 'STF/' . $year . '/' . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
    }
}
