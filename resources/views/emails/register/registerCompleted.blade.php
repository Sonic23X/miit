@component('mail::message')
@if ($type == 1)
<div style="display: flex; justify-content:center;">
    <img src="{{ $image }}" alt="logo_foro_canadevi_2022"
        style="height: 6rem; margin-bottom: 1.5rem;">
</div>
# Hola {{ $nombre ?? '' }} ¡Gracias por haberte registrado al evento Foro Canadevi Hidalgo 2022 en su forma presencial!

El evento se llevará a cabo en el Salón Aléria el 27 de Octubre de 2022, donde el registro es a partir de las 8:30 am.
Para poder confirmar tu asistencia, será necesario hacer un pago de $700.00 en la siguiente <a href="https://pay.conekta.com/link/46da4310636949178db1f021dac5c714">liga</a>.


Una vez que se haya confirmado el pago, recibirás otro correo con la confirmación y tu QR para el acceso al evento.
@endif
@if ($type == 2)
<div style="display: flex; justify-content:center;">
    <img src="{{ $image }}" alt="logo_foro_canadevi_2022"
        style="height: 6rem; margin-bottom: 1.5rem;">
</div>
# ¡Gracias por haberte registrado al evento Foro Canadevi Hidalgo 2022 en su forma presencial!

Para más información sobre el programa del día, puedes consultarlo <a href="https://forocanadevihidalgo.com">aquí</a>.

El evento virtual es 100% gratuito y solamente tienes que entrar a la siguiente <a href="https://topia.io/forocanadevihidalgo">liga</a>.

<ol>
    <li>
        Selecciona tu nombre de usuario.
    </li>
    <li>
        Selecciona el color de tu avatar.
    </li>
    <li>
        Da permisos para que la aplicación use la cámara y el micrófono.
        <br>
        <img src="{{ asset('images/form_1.jpeg') }}" alt="instruccion_1">
    </li>
    <li>
        Hacer el “LOGIN” con tu cuenta de LinkedIn, correo electrónico, Gmail o Facebook
        <br>
        <img src="{{ asset('images/form_2.jpeg') }}" alt="instruccion_2">
    </li>
</ol>
@endif
@if ($type == 3)
<div style="display: flex; justify-content: center;">
    <img src="{{ $image }}" alt="logo_carrera_2022"
        style="height: 6rem; margin-bottom: 1.5rem;">
</div>

<b>Hola {{ $nombre }} ¡Gracias por haberte registrado a la Carrera Canadevi Hidalgo 2022!</b>

La carrera tiene un costo de admisión de $160.00 para la carrera de 7 km y de $60 para la caminata de 3 km.

Para hacer tu pago, lo tienes que hacer con tarjeta de crédito o débito en la siguiente <a href="{{ $urlPayment }}">liga</a>.

Una vez confirmado el pago recibirás un correo electrónico con un QR el cual deberás de presentar al momento de recoger tu KIT para la carrera.

¡Gracias!

@endif
@endcomponent
