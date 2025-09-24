<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PppRequest extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'cnpj',
        'company_phone',
        'company_email',
        'employee_name',
        'cpf',
        'birth_date',
        'admission_date',
        'dismissal_date',
        'job_position',
        'request_reason',
        'period_start',
        'period_end',
        'observations',
        'is_urgent',
        'urgency_reason',
        'status',
        'admin_notes',
        'processed_at',
        'price'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'admission_date' => 'date',
        'dismissal_date' => 'date',
        'period_start' => 'date',
        'period_end' => 'date',
        'is_urgent' => 'boolean',
        'processed_at' => 'datetime',
        'price' => 'decimal:2'
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

    public function calculatePrice(): float
    {
        $basePrice = 45.00;
        return $this->is_urgent ? $basePrice * 1.5 : $basePrice;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->price = $model->calculatePrice();
        });
    }
}
