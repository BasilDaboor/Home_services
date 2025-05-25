<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $contactData;

    public function __construct(array $contactData)
    {
        $this->contactData = $contactData;
    }

    public function envelope(): Envelope
    {
        $subjectMap = [
            'provider_application' => 'New Provider Application',
            'report_problem' => 'Problem Report',
            'general_message' => 'General Inquiry'
        ];

        return new Envelope(
            subject: $subjectMap[$this->contactData['subject']] ?? 'Contact Form Submission',
            replyTo: $this->contactData['email']
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
            with: ['data' => $this->contactData]
        );
    }
}
