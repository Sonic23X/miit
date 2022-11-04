<x-app-layout>

    <div class="py-12">
        <div class="overflow-hidden sm:rounded-lg max-w mx-auto px-8">
            <div class="flex flex-col ml-6 mr-6 space-y-5">
                <div class="flex flex-row space-x-5 sm:rounded-lg">
                    <button
                        id="emails"
                        onclick="emails()"
                        class="bg-blue-500 hover:bg-blue-700 text-sm text-white py-1 px-4 rounded-full"
                        style="min-width: 200px;">
                        Reenviar correos de pago
                    </button>
                    <a
                        href="{{ route('downloadForum') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-sm text-white py-1 px-4 rounded-full">
                        Descargar lista
                    </a>
                </div>
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-gray-500 text-center">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Nombre
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Correo
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Teléfono
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Modalidad
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Invitado
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Pago físico
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Pago con tarjeta
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registration as $row)
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->name }} {{ $row->first_surname }} {{ $row->second_surname }}
                                </th>
                                <td class="py-4 px-6">
                                   {{ $row->email }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $row->telephone }}
                                </td>
                                <td class="py-4 px-6 flex">
                                    <div id="mode_{{ $row->id }}">
                                    @if ($row->mode === App\Models\Canadevi::PRESENT)
                                    Presencial
                                    @else
                                    Virtual
                                    @endif
                                    </div>
                                    <a href="javascript:change({{ $row->id }})" class="ml-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-4">
                                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex justify-center">
                                        <input id="option_{{ App\Models\Canadevi::MODE_INV . '_' . $row->id }}" type="checkbox" value="{{ App\Models\Canadevi::MODE_INV }}"
                                            @if ($row->payment_mode === App\Models\Canadevi::MODE_INV) checked @endif
                                            @if ($row->payment_status === 1)
                                            disabled
                                            class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @else
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @endif
                                            onclick="validate({{ App\Models\Canadevi::MODE_INV }}, {{ $row->id }})">
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex justify-center">
                                        <input id="option_{{ App\Models\Canadevi::MODE_FIS . '_' . $row->id }}" type="checkbox" value="1"
                                            @if ($row->payment_mode === App\Models\Canadevi::MODE_FIS) checked @endif
                                            @if ($row->payment_status === 1)
                                            disabled
                                            class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @else
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @endif
                                            onclick="validate({{ App\Models\Canadevi::MODE_FIS }}, {{ $row->id }})">
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex justify-center">
                                        <input id="option_{{ App\Models\Canadevi::MODE_CARD . '_' . $row->id }}" type="checkbox" value="1"
                                            @if ($row->payment_mode === App\Models\Canadevi::MODE_CARD) checked @endif
                                            @if ($row->payment_status === 1)
                                            disabled
                                            class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @else
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @endif
                                            onclick="validate({{ App\Models\Canadevi::MODE_CARD }}, {{ $row->id }})">
                                    </div>
                                </td>
                                <td class="py-4 px-6" id="row_user_{{ $row->id }}">
                                    @if ($row->payment_status !== 1)
                                    <button
                                        onclick="setPayment({{ $row->id }})"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-light py-1 px-4 text-xs rounded-full">
                                        Actualizar
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="py-3">
                {{ $registration->links() }}
            </div>
        </div>
    </div>

    <script>
        function setPayment(id) {
            let selection = null;

            if (document.getElementById(`option_{{ App\Models\Canadevi::MODE_CARD }}_${id}`).checked)
                selection = {{ App\Models\Canadevi::MODE_CARD }}
            else if (document.getElementById(`option_{{ App\Models\Canadevi::MODE_FIS }}_${id}`).checked)
                selection = {{ App\Models\Canadevi::MODE_FIS }}
            else if (document.getElementById(`option_{{ App\Models\Canadevi::MODE_INV }}_${id}`).checked)
                selection = {{ App\Models\Canadevi::MODE_INV }}

            fetch('{{ url("api/admin/forum") }}', {
                headers:{
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                method:'POST',
                body: JSON.stringify({ mode: selection, user: id })
            })
            .then(response => response.json())
            .then(function(result){
                let card = document.getElementById(`option_{{ App\Models\Canadevi::MODE_CARD }}_${id}`)
                card.disabled = true
                card.classList.remove('bg-gray-100')
                card.classList.add('bg-gray-400')

                let fis = document.getElementById(`option_{{ App\Models\Canadevi::MODE_FIS }}_${id}`)
                fis.disabled = true
                fis.classList.remove('bg-gray-100')
                fis.classList.add('bg-gray-400')

                let inv = document.getElementById(`option_{{ App\Models\Canadevi::MODE_INV }}_${id}`)
                inv.disabled = true
                inv.classList.remove('bg-gray-100')
                inv.classList.add('bg-gray-400')

                document.getElementById(`row_user_${id}`).innerHTML = ''

                Swal.fire({
                    icon: 'success',
                    title: '¡Hecho!',
                    text: result.message,
                })
            })
            .fail(() => {
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'No se ha podido actualizar el pago, intente más tarde',
                })
            })
        }

        function validate(type, id) {
            switch (type) {
                case {{ App\Models\Canadevi::MODE_CARD }}:
                    if (document.getElementById(`option_${type}_${id}`).checked) {
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_FIS }}}_${id}`).checked = false
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_INV }}}_${id}`).checked = false
                    }
                    break;
                case {{ App\Models\Canadevi::MODE_FIS }}:
                    if (document.getElementById(`option_${type}_${id}`).checked) {
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_CARD }}}_${id}`).checked = false
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_INV }}}_${id}`).checked = false
                    }
                    break;
                case {{ App\Models\Canadevi::MODE_INV }}:
                    if (document.getElementById(`option_${type}_${id}`).checked) {
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_FIS }}}_${id}`).checked = false
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_CARD }}}_${id}`).checked = false
                    }
                    break;
            }
        }

        function emails() {
            let button = document.getElementById('emails')

            button.innerHTML = `<i class="fas fa-cog fa-spin"></i>`;
            button.disabled = true;

            fetch('{{ url("api/emails/forum") }}', {
                headers:{
                    'Content-Type': 'application/json',
                },
                method:'GET'
            })
            .then(response => response.json())
            .then(result => {
                Swal.fire({
                    icon: 'success',
                    title: '¡Hecho!',
                    text: result.message,
                    allowOutsideClick: false,
                })

                button.innerHTML = `Reenviar correos de pago`;
                button.disabled = false;
            })
            .fail(() => {
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'No se ha podido enviar los correos, intente más tarde',
                    allowOutsideClick: false,
                })

                button.innerHTML = `Reenviar correos de pago`;
                button.disabled = false;
            })
        }

        async function change(id) {
            Swal.fire({
                title: 'Modalidad',
                input: 'select',
                inputOptions: {
                    '1': 'Modo Presencial',
                    '0': 'Modo virtual'
                },
                inputPlaceholder: 'Selecciona un modo',
                showCancelButton: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value === '') {
                            resolve('Seleccione un modo de evento')
                        } else {
                            resolve()
                        }
                    })
                }
            })
            .then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ url("api/admin/forum/change/") }}/${id}`, {
                        headers:{
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        method:'POST',
                        body: JSON.stringify({ mode: result.value })
                    })
                    .then(response => response.json())
                    .then(result => {

                        let mode = document.getElementById(`mode_${id}`)
                        mode.innerHTML = result.mode;

                        Swal.fire({
                            icon: 'success',
                            title: '¡Hecho!',
                            text: result.message,
                            allowOutsideClick: false,
                        })
                    });
                }
            })
        }
    </script>
</x-app-layout>
