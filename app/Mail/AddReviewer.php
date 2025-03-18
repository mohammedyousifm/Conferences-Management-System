<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddReviewer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $ControllerName;

    public $invitationLink;
    public $ReviewerName;
    public $ControllerMessage;

    public function __construct($ControllerName, $invitationLink, $ReviewerName, $ControllerMessage)
    {
        $this->ControllerName = $ControllerName;
        $this->invitationLink = $invitationLink;
        $this->ReviewerName = $ReviewerName;
        $this->ControllerMessage = $ControllerMessage;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reviewer Invitation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.add-reviewer',
            with: [
                'ControllerName' => $this->ControllerName,
                'invitationLink' =>  $this->invitationLink,
                'ReviewerName' =>  $this->ReviewerName,
                'ControllerMessage' =>  $this->ControllerMessage,
            ]
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
