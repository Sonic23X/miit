@component('mail::message')
<div style="display: flex; justify-content: center;">
    <img src="{{ $image }}" alt="logo_carrera_2022"
        style="height: 6rem; margin-bottom: 1.5rem;">
</div>

<b>Hola {{ $nombre }}, vimos que te registraste a la carrera Canadevi Hidalgo 2022 pero no has completado el pago.</b>

Es importante contar con tu pago para que el Sábado 29 de Octubre puedas pasar por tu KIT de la carrera para poder participar. Te dejamos el link <a href="{{ $urlPayment }}">aquí</a>.

¡Muchas gracias y te esperamos!

@endcomponent
