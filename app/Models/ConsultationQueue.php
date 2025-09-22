<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationQueue extends Model
{
    use HasFactory;

    protected $table = 'consultation_queue';

    protected $fillable = [
        'patient_id',
        'consultation_id',
        'specialty',
        'position',
        'status',
        'symptoms',
        'notes',
        'estimated_wait_minutes',
        'joined_at',
        'matched_at',
        'consultation_started_at',
        'left_queue_at',
        'leave_reason',
    ];

    protected $casts = [
        'symptoms' => 'array',
        'joined_at' => 'datetime',
        'matched_at' => 'datetime',
        'consultation_started_at' => 'datetime',
        'left_queue_at' => 'datetime',
    ];

    // Relacionamentos
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    // Scopes
    public function scopeWaiting($query)
    {
        return $query->where('status', 'waiting');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['waiting', 'matched', 'in_consultation']);
    }

    public function scopeBySpecialty($query, $specialty)
    {
        return $query->where('specialty', $specialty);
    }

    public function scopeOrderedByPosition($query)
    {
        return $query->orderBy('position');
    }

    // Métodos auxiliares
    public function isWaiting(): bool
    {
        return $this->status === 'waiting';
    }

    public function isMatched(): bool
    {
        return $this->status === 'matched';
    }

    public function isInConsultation(): bool
    {
        return $this->status === 'in_consultation';
    }

    public function updatePosition(): void
    {
        $newPosition = static::where('specialty', $this->specialty)
            ->where('status', 'waiting')
            ->where('joined_at', '<', $this->joined_at)
            ->count() + 1;

        $this->update(['position' => $newPosition]);
    }

    public function calculateEstimatedWait(): int
    {
        // Estimar baseado na posição e tempo médio por consulta (15 min)
        $averageConsultationTime = 15;
        $activeProfessionals = User::whereHas('professionalProfile', function($q) {
            $q->where('specialty', $this->specialty)
              ->where('is_available', true)
              ->where('status', 'active');
        })->count();

        if ($activeProfessionals === 0) {
            return 60; // 1 hora se não há profissionais
        }

        return max(5, ($this->position - 1) * $averageConsultationTime / $activeProfessionals);
    }

    public function updateEstimatedWait(): void
    {
        $this->update([
            'estimated_wait_minutes' => $this->calculateEstimatedWait()
        ]);
    }

    public function getWaitTimeAttribute(): string
    {
        if (!$this->estimated_wait_minutes) {
            return 'Calculando...';
        }

        if ($this->estimated_wait_minutes < 60) {
            return $this->estimated_wait_minutes . ' minutos';
        }

        $hours = floor($this->estimated_wait_minutes / 60);
        $minutes = $this->estimated_wait_minutes % 60;

        return $hours . 'h' . ($minutes > 0 ? ' ' . $minutes . 'min' : '');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'waiting' => 'Aguardando',
            'matched' => 'Médico Encontrado',
            'in_consultation' => 'Em Consulta',
            'completed' => 'Concluída',
            'cancelled' => 'Cancelada',
            default => 'Desconhecido'
        };
    }

    public function leaveQueue(string $reason = 'cancelled_by_patient'): void
    {
        $this->update([
            'status' => 'cancelled',
            'left_queue_at' => now(),
            'leave_reason' => $reason
        ]);

        // Reorganizar posições
        static::where('specialty', $this->specialty)
            ->where('status', 'waiting')
            ->where('position', '>', $this->position)
            ->decrement('position');
    }

    // Eventos do modelo
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($queueEntry) {
            if (!$queueEntry->joined_at) {
                $queueEntry->joined_at = now();
            }

            if (!$queueEntry->position) {
                $queueEntry->position = static::where('specialty', $queueEntry->specialty)
                    ->where('status', 'waiting')
                    ->max('position') + 1;
            }

            if (!$queueEntry->specialty) {
                $queueEntry->specialty = 'Clínico Geral';
            }
        });

        static::created(function ($queueEntry) {
            $queueEntry->updateEstimatedWait();
        });
    }
}