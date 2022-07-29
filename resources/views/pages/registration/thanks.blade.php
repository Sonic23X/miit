<x-form-layout>
    <div class="flex flex-col mb-1 items-center">
        <img class="w-40 h-40" src="{{ asset('images/logo_expo.png') }}" alt="logo_expo_inmobiliaria">
    </div>
    <div class="flex flex-col">
        <div class="flex justify-center">
            <span class="font-bold text-2xl">
                Gracias por registrarte
            </span>
        </div>
        <div class="flex justify-center mt-3">
            <span class="text-base text-center">
                Pronto se comunicarán contigo, por lo mientras guarda este código QR y muestralo al llegar al evento
            </span>
        </div>
        <p class="flex justify-center mt-10">
            <img src="{{ asset('qrcodes/' . $person->id . '.png') }}" alt="qr"
                class="h-40">
        </p>
    </div>
</x-form-layout>
