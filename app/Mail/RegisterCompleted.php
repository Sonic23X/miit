<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Registration;

class RegisterCompleted extends Mailable
{
    use Queueable, SerializesModels;

    private $registration;
    private $image;
    private $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $row, string $route, $type)
    {
        $this->registration = $row;
        $this->image = $route;
        $this->type = $type;
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
                ->with('image', $this->image);
    }
}
