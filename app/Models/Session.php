<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'academic_sessions';
    protected $fillable = [
        'name',
        'start_date',
        'end_date'
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date'

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

    public function terms(): HasMany
    {
        return $this->hasMany(Term::class, 'session_id');
    }
}
