<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MembershipConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $submissionLink;

    public function __construct($submissionLink)
    {
        $this->submissionLink = $submissionLink;
    }

    public function build()
    {
        return $this->subject('Complete Your Membership Registration')
            ->view('emails.membership-confirmation');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Complete Your Membership Registration',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.complete-membership-enrollment-email',
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
