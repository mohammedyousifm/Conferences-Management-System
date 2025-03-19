<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaperApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $paperCode;
    public $authorName;
    public $conferenceName;
    public function __construct($paperCode, $authorName, $conferenceName)
    {
        $this->paperCode = $paperCode;
        $this->authorName = $authorName;
        $this->conferenceName = $conferenceName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Paper Approved Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.paper-approved-mail',
            with: [
                'paperCode' => $this->paperCode,
                'authorName' =>  $this->authorName,
                'conferenceName' =>  $this->conferenceName,
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
