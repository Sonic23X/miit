<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentCompleted extends Mailable
{
    use Queueable, SerializesModels;

    private $registration;
    private $image;
    private $type;
    private $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $row, string $route, int $type, string $nombre = '')
    {
        $this->registration = $row;
        $this->image = $route;
        $this->type = $type;
        $this->name = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.payment.paymentCompleted')
            ->subject("¡Preparate para tu evento!")
            ->with('registration', $this->registration)
            ->with('type', $this->type)
            ->with('image', $this->image)
            ->with('nombre', $this->name);
    }
}
