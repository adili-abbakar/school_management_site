<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Guardian extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'occupation',
        'place_of_work',
        'relationship',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function  children()
    {
        return $this->hasMany(Student::class, 'guardian_id');
    }
}
