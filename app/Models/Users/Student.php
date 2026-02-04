<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'user_id',
        'admission_number',
        'class_grade',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
