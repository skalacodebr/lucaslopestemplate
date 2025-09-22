<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'birth_date',
        'cpf',
        'phone',
        'gender',
        'address',
        'city',
        'state',
        'zip_code',
        'emergency_contact_name',
        'emergency_contact_phone',
        'medical_conditions',
        'allergies',
        'medications',
        'avatar_url',
        'is_active',
        'email_verified_at',
        'phone_verified_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'medical_conditions' => 'array',
        'allergies' => 'array',
        'medications' => 'array',
        'is_active' => 'boolean',
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    /**
     * The user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user's age.
     */
    public function getAgeAttribute(): ?int
    {
        return $this->birth_date ? $this->birth_date->age : null;
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Check if phone is verified.
     */
    public function isPhoneVerified(): bool
    {
        return !is_null($this->phone_verified_at);
    }

    /**
     * Check if email is verified.
     */
    public function isEmailVerified(): bool
    {
        return !is_null($this->email_verified_at);
    }
}
