<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CatRequest extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'cnpj',
        'company_phone',
        'company_email',
        'company_address',
        'employee_name',
        'cpf',
        'birth_date',
        'job_position',
        'admission_date',
        'employee_phone',
        'accident_date',
        'accident_time',
        'accident_location',
        'accident_description',
        'injury_type',
        'injured_body_part',
        'witnesses',
        'medical_care',
        'hospital_name',
        'doctor_name',
        'medical_report',
        'attachments',
        'status',
        'admin_notes',
        'processed_at'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'admission_date' => 'date',
        'accident_date' => 'date',
        'accident_time' => 'datetime',
        'medical_care' => 'boolean',
        'attachments' => 'array',
        'processed_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function billings(): MorphMany
    {
        return $this->morphMany(Billing::class, 'billable');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pendente',
            'processing' => 'Em Processamento',
            'completed' => 'Concluída',
            'cancelled' => 'Cancelada',
            default => $this->status
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'processing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }
}
