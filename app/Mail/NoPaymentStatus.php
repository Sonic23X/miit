<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoPaymentStatus extends Mailable
{
    use Queueable, SerializesModels;

    private $image = '';
    private $name = '';
    private $urlPayment = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url, string $name, string $payment)
    {
        $this->image = $url;
        $this->name = $name;
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.race.nopayment')
            ->subject("¡No olvides tu pago!")
            ->with('image', $this->image)
            ->with('urlPayment', $this->urlPayment)
            ->with('nombre', $this->name);
    }
}
