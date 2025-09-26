<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, softDeletes;
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone_number',
        'user_type',
        'document_url',
        'is_verified_email',
        'is_verified_admin',
        'is_trusted',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🔹 علاقات
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
