<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicClass extends Model
{
    use HasFactory;
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'level',
        'next_class_id'
    ];

    public function next(): ?self
    {
        if ($this->next_class_id) {
            return self::find($this->next_class_id);
        }
        return null;
    }

    public function nextClass(): BelongsTo
    {
        return $this->belongsTo(self::class, 'next_class_id');
    }

    public function arms(): HasMany
    {
        return $this->hasMany(ClassArm::class, 'class_id');
    }

    public function teachersCount(): int
    {
        return $this->arms()
            ->whereNotNull('teacher_id')
            ->distinct('teacher_id')
            ->count('teacher_id');
    }
}
