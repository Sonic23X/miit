<x-form-layout>
    <div class="flex flex-col mb-1 items-center">
        <img class="h-24 mb-6" src="{{ asset('images/foto_canadevi.png') }}" alt="logo">
    </div>
    <div class="flex flex-col">
        <div class="flex justify-center">
            <span class="font-bold text-2xl">
                @if ($person->mode == App\Models\Canadevi::VIRTUAL)
                ¡Gracias por haberte registrado al evento virtual del Foro Canadevi Hidalgo 2022!
                @else
                ¡Gracias por haberte registrado al evento del Foro Canadevi Hidalgo 2022!
                @endif
            </span>
        </div>
        <div class="flex justify-center mt-3">
            <span class="text-base text-center">
                Hola {{ $person->name }}, pronto se comunicarán contigo, por lo mientras guarda este código QR y muestralo al llegar al evento,
                de la misma forma te llegará tu correo tu código QR.
            </span>
        </div>
        @if ($person->mode == App\Models\Canadevi::VIRTUAL)
        <div class="flex flex-col justify-center mt-4">
            <p class="text-center">
                Tu registro continuará en la siguiente plataforma, serás redirigido a la página en unos segundos.
            </p>
            <p class="text-center">
                Si la redirección no se hace automaticamente en <span id="seconds">15</span> segundos,
                haz click <a href="https://topia.io/forocanadevihidalgo">aquí</a>
            </p>
        </div>
        @endif
    </div>

    @if ($person->mode == App\Models\Canadevi::VIRTUAL)
    @slot('script')
        <script>
            const seconds = document.getElementById('seconds')
            let segundos = 15

            let reloj = setInterval(cron, 1000)
            setTimeout(redirect, 15000)

            function redirect() {
                window.location.href = 'https://topia.io/forocanadevihidalgo'
                clearInterval(reloj)
            }

            function cron() {
                segundos = segundos - 1
                seconds.innerHTML = `${segundos}`
            }

        </script>
    @endslot
    @endif
</x-form-layout>
