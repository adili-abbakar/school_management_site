<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'activity',
        'session_id'
    ];

    protected function casts(): array
    {
        return [
            'end_date' => 'date',
            'start_date' => 'date'
        ];
    }

    public function startDate()
    {
        return $this->start_date ? $this->start_date->translatedFormat('l, jS F, Y') : 'Not Set';
    }

    public function endDate()
    {
        return $this->end_date ? $this->end_date->translatedFormat('l, jS F, Y') : 'Not Set';
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public static function currentTerm()
    {
        return self::where('activity', 'active')->first();
    }
}
