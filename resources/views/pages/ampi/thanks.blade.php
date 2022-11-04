<x-form-layout>
    <div class="flex flex-col mb-1 items-center">
        <img class="h-24 mb-6" src="{{ asset('images/logo_ampi.png') }}" alt="logo">
    </div>
    <div class="flex flex-col">
        <div class="flex justify-center">
            <span class="font-bold text-2xl">
                ¡Gracias por haberte registrado al evento!
            </span>
        </div>
        <div class="flex justify-center mt-3">
            <span class="text-base text-center">
                Hola {{ $person->name }}, en breve te llegará un correo con las instrucciones a seguir para pagar tu entrada.
            </span>
        </div>
    </div>
</x-form-layout>
