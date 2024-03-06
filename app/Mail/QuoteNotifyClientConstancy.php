<?php

namespace App\Mail;

use App\Models\EstadoCotizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteNotifyClientConstancy extends Mailable
{
    use Queueable, SerializesModels;
    public string $message = '', $subjectStatus = '';
    /**
     * Create a new message instance.
     */
    public function __construct(public $quote)
    {
        $messages = [
            EstadoCotizacion::ACCEPTED => __('lang.quote.client_accept'),
            EstadoCotizacion::CANCELED => __('lang.quote.client_cancel'),
            EstadoCotizacion::REVISION => __('lang.quote.client_review'),
        ];

        $this->message = $messages[$quote->estado_cotizacion_id] ?? '';
        $this->subjectStatus = __('lang.' . strtolower(EstadoCotizacion::STATUS[$quote->estado_cotizacion_id]));
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('lang.quote.updated_status_quote', ['status' => $this->subjectStatus]),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.project.quote-notify-client-constancy',
            with: [
                'messageClient' => $this->message,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
