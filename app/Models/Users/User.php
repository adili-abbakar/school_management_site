<?php

namespace App\Models\Users;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'email', 'password', 'phone', 'date_of_birth', 'gender', 'nationality', 'state', 'local_government', 'address', 'religion', 'tribe', 'last_login_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date'
        ];
    }

    public function getFullNameAttribute()
    {
        return trim(
            collect([$this->first_name, $this->middle_name, $this->last_name])
                ->filter()
                ->implode(' '),
        );
    }

    function lastLogin()
    {
        return $this->last_login_at ? $this->last_login_at->diffForHumans() : 'Never logged in';
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class, 'user_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    public function getRolesAttribute(): array
    {
        $roles = [];

        if ($this->relationLoaded('admin') ? $this->admin : $this->admin()->exists()) {
            $roles[] = 'admin';
        }

        if ($this->relationLoaded('teacher') ? $this->teacher : $this->teacher()->exists()) {
            $roles[] = 'teacher';
        }

        if ($this->relationLoaded('guardian') ? $this->guardian : $this->guardian()->exists()) {
            $roles[] = 'guardian';
        }

        if ($this->relationLoaded('student') ? $this->student : $this->student()->exists()) {
            $roles[] = 'student';
        }

        return $roles;
    }

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class, 'user_id');
    }

    public function isStaff(): bool
    {
        return in_array('admin', $this->roles) || in_array('teacher', $this->roles);
    }
}
