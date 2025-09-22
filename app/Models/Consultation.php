<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'professional_id',
        'type',
        'specialty',
        'scheduled_at',
        'started_at',
        'ended_at',
        'status',
        'fee',
        'payment_status',
        'payment_method',
        'payment_id',
        'notes',
        'diagnosis',
        'prescription',
        'agora_channel_name',
        'agora_token',
        'duration_minutes',
        'symptoms',
        'attachments',
        'follow_up_required',
        'follow_up_date',
        'rating',
        'review',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'follow_up_date' => 'datetime',
        'symptoms' => 'array',
        'attachments' => 'array',
        'fee' => 'decimal:2',
        'rating' => 'decimal:2',
        'follow_up_required' => 'boolean',
    ];

    // Relacionamentos
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    public function participants()
    {
        return $this->hasMany(ConsultationParticipant::class);
    }

    public function queueEntry()
    {
        return $this->hasOne(ConsultationQueue::class);
    }

    // Scopes
    public function scopeScheduled($query)
    {
        return $query->where('type', 'scheduled');
    }

    public function scopeLiveQueue($query)
    {
        return $query->where('type', 'live_queue');
    }

    public function scopeBySpecialty($query, $specialty)
    {
        return $query->where('specialty', $specialty);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('scheduled_at', today());
    }

    // Métodos auxiliares
    public function isScheduled(): bool
    {
        return $this->type === 'scheduled';
    }

    public function isLiveQueue(): bool
    {
        return $this->type === 'live_queue';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function canStart(): bool
    {
        if ($this->isScheduled()) {
            return $this->status === 'confirmed' &&
                   $this->scheduled_at <= now()->addMinutes(15); // 15 min antes
        }

        return $this->status === 'pending' && $this->professional_id;
    }

    public function generateAgoraChannel(): string
    {
        if (!$this->agora_channel_name) {
            $this->agora_channel_name = 'consultation_' . $this->id . '_' . time();
            $this->save();
        }

        return $this->agora_channel_name;
    }

    public function calculateDuration(): ?int
    {
        if ($this->started_at && $this->ended_at) {
            return $this->started_at->diffInMinutes($this->ended_at);
        }

        return null;
    }

    public function getFormattedFeeAttribute(): string
    {
        return 'R$ ' . number_format($this->fee, 2, ',', '.');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pendente',
            'confirmed' => 'Confirmada',
            'in_progress' => 'Em Andamento',
            'completed' => 'Concluída',
            'cancelled' => 'Cancelada',
            'no_show' => 'Paciente Faltou',
            default => 'Desconhecido'
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'scheduled' => 'Agendada',
            'live_queue' => 'Fila Ao Vivo',
            default => 'Desconhecido'
        };
    }

    // Eventos do modelo
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($consultation) {
            if (!$consultation->status) {
                $consultation->status = $consultation->type === 'scheduled' ? 'pending' : 'pending';
            }
        });

        static::updating(function ($consultation) {
            // Calcular duração automaticamente
            if ($consultation->isDirty(['started_at', 'ended_at'])) {
                $consultation->duration_minutes = $consultation->calculateDuration();
            }
        });
    }
}