<?php

namespace App\Mail;

use App\Models\MemberApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MemberApplicationSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public MemberApplication $application)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'VAGO — Đăng ký hội viên mới: '.$this->application->full_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.member-application-submitted',
        );
    }
}
