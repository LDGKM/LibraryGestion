<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const ROLE_USER='user';
    const ROLE_ADMIN='admin';
    const ROLE_SUPERADMIN='superadmin';
    const STATUS_SUSPENDED='suspended';
    const STATUS_BLOCKED='blocked';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(){
        return $this->role===self::ROLE_ADMIN;
    }

    public function isSuperAdmin(){
        return $this->role===self::ROLE_SUPERADMIN;
    }

    public function isUser(){
        return $this->role===self::ROLE_USER;
    }

    public function isSuspended(){
        return $this->status===self::STATUS_SUSPENDED;
    }

    public function isBlocked(){
        return $this->status===self::STATUS_BLOCKED;
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
