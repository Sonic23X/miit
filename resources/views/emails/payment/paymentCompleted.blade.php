@component('mail::message')
@if ($type == 1)
<div style="display: flex; justify-content:center;">
    <img src="{{ $image }}" alt="logo_foro_canadevi_2022"
        style="height: 6rem; margin-bottom: 1.5rem;">
</div>
Hola {{ $nombre }}. ¡Gracias por tu pago!

A continuación te mandamos el código QR que necesitarás presentar para tu acceso al evento.  Recuerda llegar a tiempo, ya que el registro empieza 8:30 am y el evento a las 9:00 am.
@endif
@if ($type == 2)
<div style="display: flex; justify-content:center;">
    <img src="{{ $image }}" alt="logo_carrera_2022"
        style="height: 6rem; margin-bottom: 1.5rem;">
</div>
Hola {{ $nombre }}. ¡Gracias por tu pago!

A continuación te mandamos el código QR que necesitarás presentar para tu acceso a la carrera.  Recuerda que tienes que estar en el Estadio Revolución a las 7:15 para empezar el calentamiento.  La carrera sale a las 7:30 am y la caminata a las 7:45 am.

Para recoger tu KIT será el Viernes 28 de Octubre de 2022 en las oficinas de Canadevi ubicadas en calle Fracc. Comercial y de Servicios 14 lote 6, fraccionamiento El Palmar, Pachuca, Hidalgo CP 42088 de 9:00 am a 6:00 pm

Anexo a este correo encontrarás la carta de Exclusión, la cual deberás de entregar llenada y firmada al momento de la entrega de tu KIT.

@endif

<div style="display: flex; justify-content:center;">
    <img src="{{ asset('qrcodes/'. $registration .'.png') }}" alt="qr_code"
        style="width: 50%;">
</div>

@endcomponent
