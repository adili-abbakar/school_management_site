<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassLevel extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'section_id'
    ];

    public function section(){
        return $this->belongsTo(Section::class);
    }
    
}
