<?php

namespace App\Mail;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultationReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Consultation $consultation
    ) {}

    public function envelope(): Envelope
    {
        // Tidak pakai emoji — beberapa SMTP server/mail client menolak emoji di subject header
        return new Envelope(
            subject: 'Jawaban Konsultasi Anda - MI Terpadu Ibnu Sina',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.consultation-reply',
        );
    }
}
