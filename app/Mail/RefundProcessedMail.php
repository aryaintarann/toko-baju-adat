<?php

namespace App\Mail;

use App\Models\Refund;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RefundProcessedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Refund $refund;

    /**
     * Create a new message instance.
     */
    public function __construct(Refund $refund)
    {
        $this->refund = $refund;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statusText = $this->refund->status === 'approved' ? 'Disetujui' : 'Ditolak';

        return new Envelope(
            subject: 'Pengajuan Refund Anda ' . $statusText . ' - ' . $this->refund->order->order_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.customer.refund-processed',
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
