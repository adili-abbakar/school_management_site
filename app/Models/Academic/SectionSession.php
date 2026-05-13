<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'section_id',
        'session_id',
        'academic_sessions',
        'start_date',
        'end_date',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date'
        ];
    }
}
