<?php

namespace App\Mail;

use App\Models\EstadoCotizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteNotifyAdministratorFromClientDecision extends Mailable
{
    use Queueable, SerializesModels;
    public string $subjectMessage = '', $message = '';
    /**
     * Create a new message instance.
     */
    public function __construct(public $quote, public $clientStatusQuote, public $user)
    {
        //
        $messages = [
            EstadoCotizacion::ACCEPTED => __('lang.accept'),
            EstadoCotizacion::CANCELED => __('lang.cancel'),
            EstadoCotizacion::REVISION => __('lang.review'),
        ];

        $this->subjectMessage = __('lang.quote.quote_reply_subject_email_administrator', ['quote_name' => $quote->name, 'client_name' => $quote->proyecto->usuario_cliente->getCompleteName()]);
        $statusQuote = strtolower(__('lang.' . strtolower($messages[$quote->estado_cotizacion_id])));
        $this->message = __('lang.quote.message_to_administrator_email', ['status_quote' => $statusQuote, 'client_name' => $quote->proyecto->usuario_cliente->getCompleteName()]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectMessage,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.project.quote-notify-administrator-from-client-decision',
            with: [
                'messageAdministrator' => $this->message,
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
