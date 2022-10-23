<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use \Illuminate\Mail\Mailables\Attachment;

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
     * Get the attachments for the message.
     *
     * @return \Illuminate\Mail\Mailables\Attachment[]
     */
    public function attachments()
    {

        if ($this->type === 3)
            return [
                Attachment::fromPath(public_path('pdf/convocatoria_carrera.pdf'))
                ->as('Convocatoria.pdf')
            ];
        else
            return [ ];
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
