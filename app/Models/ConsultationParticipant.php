<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ConsultationParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'user_id',
        'role',
        'joined_at',
        'left_at',
        'audio_enabled',
        'video_enabled',
        'connection_status',
        'connection_quality',
        'duration_seconds',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'left_at' => 'datetime',
        'audio_enabled' => 'boolean',
        'video_enabled' => 'boolean',
        'connection_quality' => 'array',
        'duration_seconds' => 'integer',
    ];

    // Relacionamentos
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeConnected($query)
    {
        return $query->where('connection_status', 'connected');
    }

    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopePatients($query)
    {
        return $query->where('role', 'patient');
    }

    public function scopeProfessionals($query)
    {
        return $query->where('role', 'professional');
    }

    // Métodos auxiliares
    public function isPatient(): bool
    {
        return $this->role === 'patient';
    }

    public function isProfessional(): bool
    {
        return $this->role === 'professional';
    }

    public function isConnected(): bool
    {
        return $this->connection_status === 'connected';
    }

    public function isDisconnected(): bool
    {
        return $this->connection_status === 'disconnected';
    }

    public function join(): void
    {
        $this->update([
            'joined_at' => now(),
            'connection_status' => 'connected',
        ]);
    }

    public function leave(): void
    {
        $this->update([
            'left_at' => now(),
            'connection_status' => 'disconnected',
            'duration_seconds' => $this->calculateDuration(),
        ]);
    }

    public function toggleAudio(): void
    {
        $this->update(['audio_enabled' => !$this->audio_enabled]);
    }

    public function toggleVideo(): void
    {
        $this->update(['video_enabled' => !$this->video_enabled]);
    }

    public function updateConnectionStatus(string $status, array $quality = null): void
    {
        $updateData = ['connection_status' => $status];

        if ($quality) {
            $updateData['connection_quality'] = $quality;
        }

        $this->update($updateData);
    }

    public function calculateDuration(): int
    {
        if (!$this->joined_at) {
            return 0;
        }

        $endTime = $this->left_at ?? now();
        return $this->joined_at->diffInSeconds($endTime);
    }

    public function getFormattedDurationAttribute(): string
    {
        $seconds = $this->duration_seconds;

        if ($seconds < 60) {
            return $seconds . 's';
        }

        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;

        if ($minutes < 60) {
            return $minutes . 'min' . ($remainingSeconds > 0 ? ' ' . $remainingSeconds . 's' : '');
        }

        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        return $hours . 'h' . ($remainingMinutes > 0 ? ' ' . $remainingMinutes . 'min' : '');
    }

    public function getConnectionStatusLabelAttribute(): string
    {
        return match($this->connection_status) {
            'connected' => 'Conectado',
            'disconnected' => 'Desconectado',
            'reconnecting' => 'Reconectando',
            default => 'Desconhecido'
        };
    }

    public function getRoleLabelAttribute(): string
    {
        return match($this->role) {
            'patient' => 'Paciente',
            'professional' => 'Profissional',
            default => 'Desconhecido'
        };
    }

    // Eventos do modelo
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($participant) {
            if (!$participant->joined_at) {
                $participant->joined_at = now();
            }

            if (!$participant->connection_status) {
                $participant->connection_status = 'connected';
            }
        });

        static::updating(function ($participant) {
            // Atualizar duração se saiu da chamada
            if ($participant->isDirty('left_at') && $participant->left_at) {
                $participant->duration_seconds = $participant->calculateDuration();
            }
        });
    }
}
