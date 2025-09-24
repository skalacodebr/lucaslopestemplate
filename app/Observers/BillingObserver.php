<?php

namespace App\Observers;

use App\Models\Billing;
use App\Mail\BillingCreated;
use Illuminate\Support\Facades\Mail;

class BillingObserver
{
    /**
     * Handle the Billing "created" event.
     */
    public function created(Billing $billing): void
    {
        // Enviar e-mail quando cobrança é criada
        try {
            Mail::to($billing->user->email)->send(new BillingCreated($billing));
        } catch (\Exception $e) {
            // Log do erro, mas não impede o fluxo
            \Log::error('Erro ao enviar e-mail de cobrança: ' . $e->getMessage());
        }
    }

    /**
     * Handle the Billing "updated" event.
     */
    public function updated(Billing $billing): void
    {
        // Você pode adicionar notificações para mudanças de status aqui
        if ($billing->wasChanged('status') && $billing->status === 'paid') {
            // Opcional: enviar e-mail de confirmação de pagamento
        }
    }

    /**
     * Handle the Billing "deleted" event.
     */
    public function deleted(Billing $billing): void
    {
        //
    }

    /**
     * Handle the Billing "restored" event.
     */
    public function restored(Billing $billing): void
    {
        //
    }

    /**
     * Handle the Billing "force deleted" event.
     */
    public function forceDeleted(Billing $billing): void
    {
        //
    }
}