<?php

namespace App\Mail;

use App\Models\CatRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CatRequestSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public CatRequest $catRequest
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Solicitação CAT Recebida - Global SST',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.cat-request-submitted',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}