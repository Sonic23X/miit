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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $row)
    {
        $this->registration = $row;
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
                ->with('registration', $this->registration);
    }
}
