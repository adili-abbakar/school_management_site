<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'staff_number',
        'role_type',
        'highest_qualification',
        'years_of_experience',
        'start_date',
        'employment_type'
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date'
        ];
    }
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'int';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
