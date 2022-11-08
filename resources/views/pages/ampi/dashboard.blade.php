<x-app-layout>
    @include('layouts.navigation2')
    <main>
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
                                        Invitado
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Invitado especial
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Pago físico
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Transferencia
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
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center">
                                            <input id="option_{{ App\Models\Ampi::MODE_INV . '_' . $row->id }}" type="checkbox" value="{{ App\Models\Ampi::MODE_INV }}"
                                                @if ($row->payment_mode === App\Models\Ampi::MODE_INV) checked @endif
                                                @if ($row->payment_status === 1)
                                                disabled
                                                class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                @else
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                @endif
                                                onclick="validate({{ App\Models\Ampi::MODE_INV }}, {{ $row->id }})">
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center">
                                            <input id="option_{{ App\Models\Ampi::MODE_ESP_INV . '_' . $row->id }}" type="checkbox" value="1"
                                                @if ($row->payment_mode === App\Models\Ampi::MODE_ESP_INV) checked @endif
                                                @if ($row->payment_status === 1)
                                                disabled
                                                class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                @else
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                @endif
                                                onclick="validate({{ App\Models\Ampi::MODE_ESP_INV }}, {{ $row->id }})">
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center">
                                            <input id="option_{{ App\Models\Ampi::MODE_FIS . '_' . $row->id }}" type="checkbox" value="1"
                                                @if ($row->payment_mode === App\Models\Ampi::MODE_FIS) checked @endif
                                                @if ($row->payment_status === 1)
                                                disabled
                                                class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                @else
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                @endif
                                                onclick="validate({{ App\Models\Ampi::MODE_FIS }}, {{ $row->id }})">
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center">
                                            <input id="option_{{ App\Models\Ampi::MODE_TRANS . '_' . $row->id }}" type="checkbox" value="1"
                                                @if ($row->payment_mode === App\Models\Ampi::MODE_TRANS) checked @endif
                                                @if ($row->payment_status === 1)
                                                disabled
                                                class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                @else
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                @endif
                                                onclick="validate({{ App\Models\Ampi::MODE_TRANS }}, {{ $row->id }})">
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center">
                                            <input id="option_{{ App\Models\Ampi::MODE_CARD . '_' . $row->id }}" type="checkbox" value="1"
                                                @if ($row->payment_mode === App\Models\Ampi::MODE_CARD) checked @endif
                                                @if ($row->payment_status === 1)
                                                disabled
                                                class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                @else
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                @endif
                                                onclick="validate({{ App\Models\Ampi::MODE_CARD }}, {{ $row->id }})">
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

                if (document.getElementById(`option_{{ App\Models\Ampi::MODE_CARD }}_${id}`).checked)
                    selection = {{ App\Models\Ampi::MODE_CARD }}
                else if (document.getElementById(`option_{{ App\Models\Ampi::MODE_FIS }}_${id}`).checked)
                    selection = {{ App\Models\Ampi::MODE_FIS }}
                else if (document.getElementById(`option_{{ App\Models\Ampi::MODE_INV }}_${id}`).checked)
                    selection = {{ App\Models\Ampi::MODE_INV }}
                else if (document.getElementById(`option_{{ App\Models\Ampi::MODE_ESP_INV }}_${id}`).checked)
                    selection = {{ App\Models\Ampi::MODE_ESP_INV }}
                else if (document.getElementById(`option_{{ App\Models\Ampi::MODE_TRANS }}_${id}`).checked)
                    selection = {{ App\Models\Ampi::MODE_TRANS }}

                fetch('{{ url("api/admin/ampi") }}', {
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    method:'POST',
                    body: JSON.stringify({ mode: selection, user: id })
                })
                .then(response => response.json())
                .then(function(result){
                    let card = document.getElementById(`option_{{ App\Models\Ampi::MODE_CARD }}_${id}`)
                    card.disabled = true
                    card.classList.remove('bg-gray-100')
                    card.classList.add('bg-gray-400')

                    let fis = document.getElementById(`option_{{ App\Models\Ampi::MODE_FIS }}_${id}`)
                    fis.disabled = true
                    fis.classList.remove('bg-gray-100')
                    fis.classList.add('bg-gray-400')

                    let inv = document.getElementById(`option_{{ App\Models\Ampi::MODE_INV }}_${id}`)
                    inv.disabled = true
                    inv.classList.remove('bg-gray-100')
                    inv.classList.add('bg-gray-400')

                    let inv_esp = document.getElementById(`option_{{ App\Models\Ampi::MODE_ESP_INV }}_${id}`)
                    inv_esp.disabled = true
                    inv_esp.classList.remove('bg-gray-100')
                    inv_esp.classList.add('bg-gray-400')

                    let trans = document.getElementById(`option_{{ App\Models\Ampi::MODE_TRANS }}_${id}`)
                    trans.disabled = true
                    trans.classList.remove('bg-gray-100')
                    trans.classList.add('bg-gray-400')

                    document.getElementById(`row_user_${id}`).innerHTML = ''

                    Swal.fire({
                        icon: 'success',
                        title: '¡Hecho!',
                        text: result.message,
                    })
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'No se ha podido actualizar el pago, intente más tarde',
                    })
                })
            }

            function validate(type, id) {
                switch (type) {
                    case {{ App\Models\Ampi::MODE_CARD }}:
                        if (document.getElementById(`option_${type}_${id}`).checked) {
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_FIS }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_INV }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_ESP_INV }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_TRANS }}}_${id}`).checked = false
                        }
                        break;
                    case {{ App\Models\Ampi::MODE_FIS }}:
                        if (document.getElementById(`option_${type}_${id}`).checked) {
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_CARD }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_INV }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_ESP_INV }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_TRANS }}}_${id}`).checked = false
                        }
                        break;
                    case {{ App\Models\Ampi::MODE_INV }}:
                        if (document.getElementById(`option_${type}_${id}`).checked) {
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_FIS }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_CARD }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_ESP_INV }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_TRANS }}}_${id}`).checked = false
                        }
                        break;
                    case {{ App\Models\Ampi::MODE_TRANS }}:
                        if (document.getElementById(`option_${type}_${id}`).checked) {
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_CARD }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_INV }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_ESP_INV }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_FIS }}}_${id}`).checked = false
                        }
                        break;
                    case {{ App\Models\Ampi::MODE_ESP_INV }}:
                        if (document.getElementById(`option_${type}_${id}`).checked) {
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_FIS }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_CARD }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_INV }}}_${id}`).checked = false
                            document.getElementById(`option_{{{ App\Models\Ampi::MODE_TRANS }}}_${id}`).checked = false
                        }
                        break;
                }
            }

            function emails() {
                let button = document.getElementById('emails')

                button.innerHTML = `<i class="fas fa-cog fa-spin"></i>`;
                button.disabled = true;

                fetch('{{ url("api/emails/ampi") }}', {
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
        </script>
    </main>
</x-app-layout>
