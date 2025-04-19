<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\UserMembership;

class MembershipReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $submissionLink;
    public $userMembership;

    public function __construct(UserMembership $userMembership)
    {
        $this->userMembership = $userMembership;
        $this->submissionLink = route('gem.memberships.upload-documents', [
            'token' => encrypt($userMembership->id)
        ]);
    }

    public function build()
    {
        return $this->subject('Reminder: Complete Your Membership Registration')
            ->view('emails.membership-reminder');
    }
}
