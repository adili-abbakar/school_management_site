<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentTermRecord extends Model
{
    protected $fillable = [
        'student_session_record_id',
        'term_id',
        'status',
        'started_at',
        'completed_at',
        'remarks',
    ];

    public function sessionRecord(): BelongsTo
    {
        return $this->belongsTo(StudentSessionRecord::class);
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    // You'll add this later when you create subject results
//     public function subjectResults(): HasMany
//     {
//         return $this->hasMany(StudentSubjectResult::class);
//     }
}
