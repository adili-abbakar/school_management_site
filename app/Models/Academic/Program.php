<?php

namespace App\Models\Academic;

use App\Models\ApplicationProgram;
use App\Models\StudentApplication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'is_default',
        'is_active'
    ];

    public function levels()
    {
        return $this->hasMany(ClassLevel::class);
    }

    public function applications()
    {
        return $this->belongsToMany(StudentApplication::class);
    }

    public function classes()
    {
        return $this->hasMany(AcademicClass::class);
    }

    public function applicationPrograms(): HasMany
    {
        return $this->hasMany(ApplicationProgram::class);
    }
}
