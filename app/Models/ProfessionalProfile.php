<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_number',
        'license_type',
        'specialty',
        'subspecialties',
        'bio',
        'years_experience',
        'education',
        'certifications',
        'languages',
        'consultation_fee',
        'rating',
        'total_reviews',
        'is_verified',
        'is_available',
        'availability_schedule',
        'max_daily_consultations',
        'status',
        'verified_at',
        'last_active_at',
    ];

    protected $casts = [
        'subspecialties' => 'array',
        'education' => 'array',
        'certifications' => 'array',
        'languages' => 'array',
        'availability_schedule' => 'array',
        'consultation_fee' => 'decimal:2',
        'rating' => 'decimal:2',
        'is_verified' => 'boolean',
        'is_available' => 'boolean',
        'verified_at' => 'datetime',
        'last_active_at' => 'datetime',
    ];

    /**
     * The user that owns the professional profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if professional is verified.
     */
    public function isVerified(): bool
    {
        return $this->is_verified && !is_null($this->verified_at);
    }

    /**
     * Check if professional is currently available.
     */
    public function isCurrentlyAvailable(): bool
    {
        return $this->is_available && $this->status === 'active';
    }

    /**
     * Get formatted consultation fee.
     */
    public function getFormattedFeeAttribute(): string
    {
        return 'R$ ' . number_format($this->consultation_fee, 2, ',', '.');
    }

    /**
     * Get rating as stars.
     */
    public function getRatingStarsAttribute(): string
    {
        $fullStars = floor($this->rating);
        $halfStar = ($this->rating - $fullStars) >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;

        return str_repeat('★', $fullStars) .
               str_repeat('☆', $halfStar) .
               str_repeat('☆', $emptyStars);
    }

    /**
     * Update rating based on new review.
     */
    public function updateRating(float $newRating): void
    {
        $totalRating = ($this->rating * $this->total_reviews) + $newRating;
        $this->total_reviews++;
        $this->rating = $totalRating / $this->total_reviews;
        $this->save();
    }

    /**
     * Scope to only verified professionals.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope to only available professionals.
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)->where('status', 'active');
    }

    /**
     * Scope by specialty.
     */
    public function scopeBySpecialty($query, string $specialty)
    {
        return $query->where('specialty', $specialty);
    }
}
