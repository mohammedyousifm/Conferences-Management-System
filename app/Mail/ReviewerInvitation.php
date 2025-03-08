<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewerInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $registrationLink;

    public function __construct($registrationLink)
    {
        $this->registrationLink = $registrationLink;
    }

    public function build()
    {
        return $this->subject('Invitation to Register as a Reviewer')
            ->view('3-emails.reviewer-invitation')
            ->with(['registrationLink' => $this->registrationLink]);
    }
}
