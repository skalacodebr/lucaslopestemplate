<?php

namespace App\Mail;

use App\Models\PppRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PppRequestSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PppRequest $pppRequest
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Solicitação PPP Recebida - Global SST',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ppp-request-submitted',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}