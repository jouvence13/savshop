<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class payMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $email;
    public $mailData;

    public function __construct($email, $mailData)
    {
        $this->email = $email;
        $this->mailData = is_array($mailData) ? $mailData : [];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Achat de service',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $article = $this->mailData['article'] ?? 'Non renseigné';
        $categorie = $this->mailData['categorie'] ?? 'Non renseignée';

        $name = isset($this->mailData['name']) ? $this->mailData['name'] : 'Non renseigné';
        $amount = isset($this->mailData['amount']) ? $this->mailData['amount'] : 'Non renseigné';
        $status = isset($this->mailData['status']) ? $this->mailData['status'] : 'Non renseigné';
        $transactionId = isset($this->mailData['transactionId']) ? $this->mailData['transactionId'] : 'Non renseigné';
        $paymentMethod = isset($this->mailData['paymentMethod']) ? $this->mailData['paymentMethod'] : 'Non renseigné';

        return new Content(
            view: 'emails.mailContent',
            with: [
                'name' => $name,
                'amount' => $amount,
                'status' => $status,
                'transactionId' => $transactionId,
                'paymentMethod' => $paymentMethod,
                'article' => $article,
                'categorie' => $categorie,
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
