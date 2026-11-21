<?php

namespace App\Models\Auth;


use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $table = 'password_reset_tokens';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];
}
