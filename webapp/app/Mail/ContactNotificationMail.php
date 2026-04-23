<?php

namespace App\Mail;

use App\Models\ContactRequest;
use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly ContactRequest $contactRequest,
        public readonly Participant $target,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '【ビジネスマッチング】連絡希望のお知らせ',
        );
    }

    public function content(): Content
    {
        $from = $this->contactRequest->fromParticipant;
        $to   = $this->contactRequest->toParticipant;

        return new Content(
            view: 'emails.contact_notification',
            with: [
                'target'          => $this->target,
                'from'            => $from,
                'to'              => $to,
                'isSender'        => $this->target->id === $from->id,
                'counterpart'     => $this->target->id === $from->id ? $to : $from,
            ],
        );
    }
}
