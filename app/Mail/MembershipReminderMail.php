<?php

namespace App\Mail;

use App\Models\UserMembership;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MembershipReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public UserMembership $userMembership)
    {
        $this->userMembership = $userMembership;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reminder: Submit Your Membership Documents',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.membership_reminder',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
