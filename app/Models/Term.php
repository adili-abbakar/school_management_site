<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Term extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
        'session_id'
    ];

    public function session() : BelongsTo {
        return $this->belongsTo(Session::class, 'session_id');
    }
}
