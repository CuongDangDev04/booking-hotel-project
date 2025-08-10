<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $receipt;
    public $pdf;

    public function __construct($receipt, $pdf)
    {
        $this->receipt = $receipt;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Thanh toán thành công')
            ->view('emails.payment_success') // view email
            ->attachData($this->pdf, 'receipt_' . $this->receipt->receipt_id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
