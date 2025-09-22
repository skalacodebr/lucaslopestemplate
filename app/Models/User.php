<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    /**
     * Determine if the user can access the Filament admin panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasPermission('access_admin') || $this->isAdmin();
    }

    /**
     * The posts that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * The user profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * The professional profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function professionalProfile()
    {
        return $this->hasOne(ProfessionalProfile::class);
    }

    /**
     * The roles that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
<<<<<<< Updated upstream
        return $this->belongsToMany(\App\Models\Role::class, 'user_roles')
=======
        return $this->belongsToMany(Role::class, 'user_roles')
>>>>>>> Stashed changes
            ->withPivot(['assigned_at', 'expires_at', 'is_active'])
            ->withTimestamps();
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole(string $roleSlug): bool
    {
<<<<<<< Updated upstream
        return $this->roles()->where('slug', $roleSlug)->where('user_roles.is_active', true)->exists();
=======
        return $this->roles()->where('slug', $roleSlug)->where('is_active', true)->exists();
>>>>>>> Stashed changes
    }

    /**
     * Check if user is a patient.
     */
    public function isPatient(): bool
    {
        return $this->hasRole('patient');
    }

    /**
     * Check if user is a professional.
     */
    public function isProfessional(): bool
    {
        return $this->hasRole('professional');
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
<<<<<<< Updated upstream
        return $this->hasRole('admin') || $this->hasRole('super-admin');
=======
        return $this->hasRole('admin');
>>>>>>> Stashed changes
    }

    /**
     * Get user's full name.
     */
    public function getFullNameAttribute(): string
    {
        if ($this->profile) {
            return trim($this->profile->first_name . ' ' . $this->profile->last_name);
        }
        return $this->name;
    }

    /**
     * Check if user has a specific permission.
     */
    public function hasPermission(string $permission): bool
    {
        return $this->roles()
<<<<<<< Updated upstream
            ->where('user_roles.is_active', true)
=======
            ->where('is_active', true)
>>>>>>> Stashed changes
            ->get()
            ->flatMap(fn($role) => $role->permissions ?? [])
            ->contains($permission);
    }

    /**
     * Check if user has any of the given permissions.
     */
    public function hasAnyPermission(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if user has all of the given permissions.
     */
    public function hasAllPermissions(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Assign role to user.
     */
    public function assignRole(string $roleSlug): void
    {
        $role = \App\Models\Role::where('slug', $roleSlug)->first();
        if ($role && !$this->hasRole($roleSlug)) {
            $this->roles()->attach($role->id, [
                'assigned_at' => now(),
                'is_active' => true,
            ]);
        }
    }

    /**
     * Remove role from user.
     */
    public function removeRole(string $roleSlug): void
    {
        $role = \App\Models\Role::where('slug', $roleSlug)->first();
        if ($role) {
            $this->roles()->detach($role->id);
        }
    }
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
}
