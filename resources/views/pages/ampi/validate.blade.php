<x-form-layout>
    <div class="flex flex-col mb-1 items-center">
        <img class="w-40 h-40" src="{{ asset('images/foto_canadevi.jpg') }}" alt="logo_expo_inmobiliaria">
    </div>
    <div class="flex flex-col mt-5">
        <span class="text-base">
            <b>Nombre:</b> {{ $person->name }} {{ $person->first_surname }}
        </span>
        <span class="text-base">
            <b>Teléfono:</b> {{ $person->telephone }}
        </span>
        <span class="text-base">
            <b>Correo:</b> {{ $person->email }}
        </span>
        <span class="text-base">
            <b>Estado de pago:</b>
            @if( $person->payment_status == 1 && $person->payment_mode != App\Models\Canadevi::MODE_INV)
            Pagado
            @elseif($person->payment_status == 1 && $person->payment_mode == App\Models\Canadevi::MODE_INV)
            Invitad@
            @else
            Sin pagar
            @endif
        </span>
    </div>
    @if(Auth::user() != null && $person->assistance == 0)
    <div class="flex mt-5" id="button_{{ $person->id }}">
        <button
            onclick="confirm({{ $person->id }})"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
            Confirmar asistencia
        </button>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirm(id) {
            fetch(`{{ url("api/admin/forum/confirm/") }}/${id}`, {
                headers:{
                    'Content-Type': 'application/json',
                },
                method:'GET',
            })
            .then(response => response.json())
            .then(result => {
                if(result.status == 200) {

                    document.getElementById(`button_${id}`).style.display = "none"

                    Swal.fire({
                        icon: 'success',
                        title: '¡Hecho!',
                        text: result.message,
                        allowOutsideClick: false,
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: 'Error al confirmar la asistencia',
                        allowOutsideClick: false,
                    })
                }
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    text: 'Error al confirmar la asistencia',
                    allowOutsideClick: false,
                })
            })
        }
    </script>
    @endif
</x-form-layout>
