<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterCompleted extends Mailable
{
    use Queueable, SerializesModels;

    private $registration;
    private $image;
    private $type;
    private $name;
    private $urlPayment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $row, string $route, int $type, string $url, string $nombre = '')
    {
        $this->registration = $row;
        $this->image = $route;
        $this->type = $type;
        $this->urlPayment = $url;
        $this->name = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.register.registerCompleted')
                ->subject("¡Registro completado!")
                ->with('registration', $this->registration)
                ->with('type', $this->type)
                ->with('image', $this->image)
                ->with('urlPayment', $this->urlPayment)
                ->with('nombre', $this->name);
    }
}
