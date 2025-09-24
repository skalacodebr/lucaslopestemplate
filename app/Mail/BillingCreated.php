<?php

namespace App\Mail;

use App\Models\Billing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BillingCreated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Billing $billing
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova Cobrança - Global SST',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.billing-created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}