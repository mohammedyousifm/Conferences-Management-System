<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReviewerComment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $ControllerName;
    public $ReviewerName;
    public $PaperCode;

    public function __construct($ControllerName, $ReviewerName, $PaperCode)
    {
        $this->ControllerName = $ControllerName;
        $this->ReviewerName = $ReviewerName;
        $this->PaperCode = $PaperCode;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reviewer Comment',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.reviewer-comment',
            with: [
                'ControllerName' => $this->ControllerName,
                'ReviewerName' => $this->ReviewerName,
                'PaperCode' => $this->PaperCode,
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
