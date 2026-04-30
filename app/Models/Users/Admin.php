<?php

namespace App\Models\Users;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'staff_id',
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



    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class,  'staff_id');
    }
}
