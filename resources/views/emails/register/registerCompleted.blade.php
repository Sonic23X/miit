@component('mail::message')
@if ($type == 1)
<div style="display: flex; justify-content:center;">
    <img src="{{ $image }}" alt="logo_foro_canadevi_2022"
        style="height: 6rem; margin-bottom: 1.5rem;">
</div>

# ¡Gracias por haberte registrado al evento Foro Canadevi Hidalgo 2022!

Para más información sobre el programa del día puedes consultarlo <a href="https://forocanadevihidalgo.com">aquí</a>

El evento tiene un costo de admisión de $700.00 los cuales tienen que ser pagados a través de estas 3 opciones:

<ol>
  <li>Pago de contado en las oficinas de Canadevi Hidalgo</li>
  <li>Pago a través de transferencia bancaria a: <b>STP: 123456789012345678</b></li>
  <li>Pago con tarjeta de débito o crédito <a href="https://pay.conekta.com/link/46da4310636949178db1f021dac5c714">aquí</a></li>
</ol>

Una vez que se haya confirmado el pago, recibirás un correo electrónico de confirmación al mismo y tu QR quedará activo.
Recuerda que lo tienes que presentar al momento de el acceso al evento.
@endif

<div style="display: flex; justify-content:center;">
    <img src="{{ asset('qrcodes/'. $registration .'.png') }}" alt="qr_code"
        style="width: 50%;">
</div>

@endcomponent
