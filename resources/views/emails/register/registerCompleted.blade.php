@component('mail::message')
# Gracias por registrarte en Miit
Muestra el siguiente código para entrar al evento

<div style="display: flex; justify-content:center;">
    <img src="{{ asset('qrcodes/'. $registration->id .'.png') }}" alt="qr_code"
        style="width: 50%;">
</div>

@endcomponent
