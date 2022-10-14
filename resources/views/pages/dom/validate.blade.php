<x-form-layout>
    <div class="flex flex-col mb-1 items-center">
        <img class="w-40 h-40" src="{{ asset('images/logo_dom.png') }}" alt="logo_dom">
    </div>
    <div class="flex flex-col">
        <div class="flex justify-center">
            <span class="font-bold text-2xl">
                Visita confirmada
            </span>
        </div>
        <div class="flex justify-center mt-3">
            <span class="text-base">
                ¡Disfruta del evento, {{ $person->name }} {{ $person->first_surname }}!
            </span>
        </div>
    </div>
</x-form-layout>
