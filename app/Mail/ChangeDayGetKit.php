<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use \Illuminate\Mail\Mailables\Attachment;

class ChangeDayGetKit extends Mailable
{
    use Queueable, SerializesModels;

    private $image = '';
    private $name = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url, string $name)
    {
        $this->image = $url;
        $this->name = $name;
    }

    /**
     * Get the attachments for the message.
     *
     * @return \Illuminate\Mail\Mailables\Attachment[]
     */
    public function attachments()
    {
        return [
            Attachment::fromPath(public_path('pdf/convocatoria_carrera.pdf'))
            ->as('Convocatoria.pdf')
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.race.changedaygetkit')
            ->subject("¡Nota importante!")
            ->with('image', $this->image)
            ->with('nombre', $this->name);
    }
}
