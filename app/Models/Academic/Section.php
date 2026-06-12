<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'is_default',
        'is_active'
    ];


    public function sectionSessions()
    {
        return $this->hasMany(SectionSession::class);
    }

    public function levels(){
        return $this->hasMany(ClassLevel::class);
    }
}
